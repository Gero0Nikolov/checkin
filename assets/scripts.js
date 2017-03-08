var FOURSQUARE_VENUE_SEARCH_API_URL = "https://api.foursquare.com/v2/venues/search?";
var FOURSQUARE_VENUE_SEARCH_API_CID = "353GZNRPJL4HJYGGVHRV1TTE5VUBPFEGWPZT0YZH0FQYMKU4";
var loading = "<div id='loader'></div>";

jQuery( document ).ready(function(){
    if ( jQuery( "#venue-search-container" ).length ) {
        jQuery( "#venue-search-box #town-search, #venue-search-box #venue-search" ).on( "keydown", function( e ){
            if ( e.keyCode == 13 ) {
                e.preventDefault();
                searchVenue( jQuery( "#venue-search-box #town-search" ).val().trim(), jQuery( "#venue-search-box #venue-search" ).val().trim() );
            }
        } );
    }
});


function searchVenue( venueTown, venue ) {
    if ( venueTown !== undefined && venueTown != "" ) {
        jQuery.ajax({
    		url: FOURSQUARE_VENUE_SEARCH_API_URL +"near="+ venueTown +"&query="+ venue +"&oauth_token="+ FOURSQUARE_VENUE_SEARCH_API_CID +"&v=20170308",
    		success: function( result ) {
    			console.log( result );
    		},
            error: function( result ) {
                console.log( result );
            }
    	});
    }
}
