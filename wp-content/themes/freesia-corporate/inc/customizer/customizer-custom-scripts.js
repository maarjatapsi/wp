( function( api ) {

	// Extends our custom "freesia-corporate" section.
	api.sectionConstructor['freesia-corporate'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
