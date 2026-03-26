/**
 * Fetch posts from custom REST API and render to DOM.
 *
 * @package Child_Theme
 */

document.addEventListener(
	'DOMContentLoaded',
	function () {
		const container = document.getElementById( 'post-list' );

		if ( ! container ) {
			console.error( 'Container #post-list not found' );
			return;
		}

		container.innerHTML = '<p>Loading posts...</p>';

		fetch(
			apiSettings.root + 'vseo/v2/posts',
			{
				method: 'GET',
				credentials: 'same-origin',
				headers: {
					'Content-Type': 'application/json',
					'X-WP-Nonce': apiSettings.nonce,
				},
			}
		)
			.then(
				function ( response ) {
					if ( ! response.ok ) {
							console.error( 'Status:', response.status );
							throw new Error(
								'API request failed with status ' + response.status
							);
					}

					return response.json();
				}
			)
			.then(
				function ( data ) {
					console.log( data );
					container.innerHTML = '';

					const posts = data.data;

					if ( ! Array.isArray( posts ) || 0 === posts.length ) {
							container.innerHTML = '<p>No posts found.</p>';
							return;
					}

					data.data.forEach(
						function ( post ) {
							const el = document.createElement( 'div' );

							el.innerHTML =
							'<p>' +
							'<a href="' + post.link + '">' + post.title + '</a>' +
							'</p>';

							container.appendChild( el );
						}
					);
				}
			)
			.catch(
				function ( error ) {
					container.innerHTML = '<p>Error loading posts.</p>';
					console.error( error );
				}
			);
	}
);