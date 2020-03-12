/**
 * Frontend entry point.
 *
 * src/front/front-index.js
 */
require( '../../../../themes/travel-tour/js/bootstrap.js' );
require( '../../../../themes/travel-tour/js/bootstrap-rtl.js' );
// require( '../../../../themes/travel-tour/js/customizer.js' );
require( '../../../../themes/travel-tour/js/owl.carousel.js' );
require( '../../../../themes/travel-tour/js/script.js' );
require( '../../../../themes/travel-tour/js/wow.js' );

const front = require( './components/front-test' );

front.log( 'Here is a message for the frontend!' );

// Let's test a function using Lodash.
front.log( front.getLastArrayElement( [ 1, 2, 3 ] ) ); // Should log out 3.