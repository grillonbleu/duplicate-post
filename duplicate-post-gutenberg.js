( function( wp ) {
	var registerPlugin            = wp.plugins.registerPlugin;
	var Fragment                  = wp.element.Fragment;
	var PluginSidebar             = wp.editPost.PluginSidebar;
	var PluginSidebarMoreMenuItem = wp.editPost.PluginSidebarMoreMenuItem;
	var el                        = wp.element.createElement;
	var Button                    = wp.components.Button;
	let Panel                     = wp.components.Panel;
	let PanelBody                 = wp.components.PanelBody;
	let PanelRow                  = wp.components.PanelRow;
	const { __, _x, _n, _nx }     = wp.i18n;

	const duplicatePostIcon = wp.element.createElement(
		'svg',
		{
			width: 20,
			height: 20
		},
		wp.element.createElement(
			'path',
			{
				d: "M18.9 4.3c0.6 0 1.1 0.5 1.1 1.1v13.6c0 0.6-0.5 1.1-1.1 1.1h-10.7c-0.6 0-1.1-0.5-1.1-1.1v-3.2h-6.1c-0.6 0-1.1-0.5-1.1-1.1v-7.5c0-0.6 0.3-1.4 0.8-1.8l4.6-4.6c0.4-0.4 1.2-0.8 1.8-0.8h4.6c0.6 0 1.1 0.5 1.1 1.1v3.7c0.4-0.3 1-0.4 1.4-0.4h4.6zM12.9 6.7l-3.3 3.3h3.3v-3.3zM5.7 2.4l-3.3 3.3h3.3v-3.3zM7.9 9.6l3.5-3.5v-4.6h-4.3v4.6c0 0.6-0.5 1.1-1.1 1.1h-4.6v7.1h5.7v-2.9c0-0.6 0.3-1.4 0.8-1.8zM18.6 18.6v-12.9h-4.3v4.6c0 0.6-0.5 1.1-1.1 1.1h-4.6v7.1h10z",
			}
		)
	);

	const DuplicatePostButton = el(
		Button,
		{
			value: 'Copy to a new draft',
			isPrimary: true,
			isLarge: true,
			href: duplicate_post_data.duplicate_post_url
		},
		__( 'Copy to a new draft', 'duplicate-post' )
	)

	registerPlugin(
		'duplicate-post',
		{
			render: function() {
				return Fragment,
					{},
					[ el(
						PluginSidebar,
						{
							name: 'duplicate-post-sidebar',
							icon: duplicatePostIcon,
							title: 'Duplicate Post',
						},
						el(
							'div',
							{ className: 'duplicate-post-sidebar-content' },
							[ el(
								Panel,
								{},
								el(
									PanelBody,
									{title: 'Override options', initialOpen: false},
									el(
										PanelRow,
										{},
										'Qui andranno le opzioni'
									)
								)
							),
								el(
									'div',
									{ className: 'duplicate-post-button-container' },
									DuplicatePostButton
								)
							]
						)
					),
					el(
						PluginSidebarMoreMenuItem,
						{
							target: 'duplicate-post-sidebar',
							icon: duplicatePostIcon,
						},
						'Duplicate Post'
					) ];
			},
		}
	);
} )( window.wp );
