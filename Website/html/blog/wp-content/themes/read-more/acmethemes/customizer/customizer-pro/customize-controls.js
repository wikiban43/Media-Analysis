( function( api ) {

	// Extends our custom "read-more" section.
	api.sectionConstructor['read-more'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );