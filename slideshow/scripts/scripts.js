/**
* @file: scripts.js
* $Purpose: Contains all javascript specific to the module
*/

// Drupal requires that you wrap jQuery within a closure
(function ($) {
    // Owl Carousel config for main slider
    $(document).ready(function(){
        // Declare Variables
        var slideshowMain = $("#owl-slideshow-main");
        var slideshowThumbnails = $("#owl-slideshow-thumbnails");
        var slideCount = $("#owl-slideshow-main").attr("slide-count");

        // This accounts for when # of uploaded slide images is less than the items in the thumbnail tray
        if (slideCount < 7) {
            console.log("slide-count is less than 7");
            var itemCount = slideCount;
        }
        else {
            console.log("slide-count is more than 7");
            var itemCount = 7;
        };

        // Initialize Slideshow Main
        slideshowMain.owlCarousel({
            items: 1,
            nav:true,
            loop: true,
            dots:false,
            autoplay: false,
            lazyLoad: true,
            URLhashListener:true, // Makes sure that slides with the same data-hash are synced
            startPosition: "URLHash", // Makes sure that the slideshowMain carousel starts at the same item as the slideshowThumbnails carousel
        }); // End of Slideshow Main configuration

        // We need to call this before the slider is initialized in order to set an active class in the thumbnail carousel
        slideshowThumbnails.on("initialized.owl.carousel", function(event) {
            setTimeout( function(){ activeItem( event ); }, 10 );
        });

        // Initialize Slideshow Thumbnails
        slideshowThumbnails.owlCarousel({
            nav:true,
            loop: true,
            dots:false,
            margin: 12,
            URLhashListener:true, // Makes sure that slides with the same data-hash are synced
            startPosition: "URLHash", //This makes sure that the slideshowThumbnails carousel starts at the same item as the slideshowMain carousel
            //onChanged: activeItem,
            responsive : {
                // Breakpoint from 0px up
                0 : {
                    items: itemCount,
                },
                // Breakpoint from 480px up
                480 : {
                    items: itemCount,
                },
                // Breakpoint from 768px up
                768 : {
                    items: itemCount
                }
            }
        }); // End of Slideshow Thumbnails configuration
        slideshowThumbnails.on("change.owl.carousel", function(event) {
            setTimeout( function(){ activeItem( event ); }, 300 ); // This is to compensate for the slide transitions in owl carousel
        });

        /**
         * @function activeItem()
         * @purpose This syncs the active class of the slideshowThumbnails carousel with SlideshowMain
         * @param event
         */
        function activeItem( event ){
            console.log("activeItem() - Slide Changed");
            $("#owl-slideshow-thumbnails").find(".owl-item").removeClass( "active-item" ); //TODO: Clean this up. There are duplicated jQuery selectors
            $("#owl-slideshow-thumbnails").find(".owl-item").addClass( "inactive-item" );
            $("#owl-slideshow-thumbnails").find(".owl-item.active").first().delay(550).addClass( "active-item" );
        }
    }); // End of Document Ready
}(jQuery)); // Here we call the function with jQuery as the parameter

/**
 * @function fullscreenSlider()
 * @purpose Toggles fullscreen class on id, then refreshes owl carousel
 * @type {{fullscreenSlider: UI.fullscreenSlider}}
 */
var UI = {
    fullscreenSlider: function() {
        console.log("fullscreenSlide() - Fullscreen Toggle Fired");
        var element = document.getElementById("fullscreen");
        element.classList.toggle("fullscreen");
        jQuery("#owl-slideshow-main").owlCarousel("refresh");
    }
}; // End of fullscreenSlider()
//End of file
