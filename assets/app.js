/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
import * as bootstrap from 'bootstrap';
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import { startStimulusApp } from '@symfony/stimulus-bridge';

export const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.(j|t)sx?$/
));

import logoPath from './images/flore.png';

import { Tooltip, Toast, Popover } from 'bootstrap';
// start the Stimulus application
import './bootstrap';

//for modal bootstrap
const container = document.getElementById("exampleModal");
const modal = new bootstrap.Modal(container);

document.getElementById("myInput").addEventListener("click", function () {
    modal.show();
});
document.getElementById("close").addEventListener("click", function () {
    modal.hide();
});
document.getElementById("closeFooter").addEventListener("click", function () {
    modal.hide();
});


const $ = require('jquery');
//for less or more post in home
$(function () {
    $("div.posts").slice(4).hide();
    $("#loadLessPost").hide("slow");
    $("#loadMorePost").on('click', function(e){
        e.preventDefault();
        $("div.posts:hidden").slice(0, 4).slideDown();
        if ($("div.posts:hidden").length === 0) {
            $("#loadMorePost").hide("slow");
            $("#loadLessPost").show("slow");
        }
    });
    $("#loadLessPost").on('click', function(e){
        e.preventDefault();
        $("div.posts").slice(4, $("div.posts").length).hide();
        $("#loadLessPost").hide("slow");
        $("#loadMorePost").show("slow");

    });
});

//photo hide and show in comment/post.html.twig and user/show.html.twig template
$(function (){
    $("div.image").slice(3).hide();
    if ($("div.image").length < 4) {
        $("#loadMediaimage").hide();
        $("#hideMediaimage").hide();
    }
    $("#hideMediaimage").hide();
    $("#loadMediaimage").on('click', function(e){
        e.preventDefault();
        $("div.image:hidden").slice(0, 3).slideDown();
        $("#hideMediaimage").show();
        if ($("div.image:hidden").length === 0) {
            $("#loadMediaimage").hide();
            $("#hideMediaimage").show();
        }
    });
    $("#hideMediaimage").on('click', function(e){
        e.preventDefault();
        $("div.image").slice(3, $("div.image").length).hide();
        $("#hideMediaimage").hide();
        $("#loadMediaimage").show();
    });
});

$(function (){
    $("div.video").slice(3).hide();
    if ($("div.video").length < 4) {
        $("#loadMediavideo").hide();
        $("#hideMediavideo").hide();
    }
    $("#hideMediavideo").hide();
    $("#loadMediavideo").on('click', function(e){
        e.preventDefault();
        $("div.video:hidden").slice(0, 3).slideDown();
        $("#hideMediavideo").show();
        if ($("div.video:hidden").length === 0) {
            $("#loadMediavideo").hide();
            $("#hideMediavideo").show();
        }
    });
    $("#hideMediavideo").on('click', function(e){
        e.preventDefault();
        $("div.video").slice(3, $("div.video").length).hide();
        $("#hideMediavideo").hide();
        $("#loadMediavideo").show();
    });
});

var $collectionHolder;

// setup an "add a tag" link
var $addTagButton = $('<button type="button" class="btn btn-outline-primary">Ajoutez une video</button>');
var $newLinkLi = $("<li></li>").append($addTagButton);

$(function() {
    // Get the ul that holds the collection of tags
    $collectionHolder = $("ul.videos");

    $collectionHolder.find("li").each(function() {
        addTagFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);
     

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data("index", $collectionHolder.find("input").length);

    $addTagButton.on("click", function(e) {
        // add a new tag form (see next code block)
        addTagForm($collectionHolder, $newLinkLi);
    });

    $removeTagButton.on("click", function(e) {
        // add a new tag form (see next code block)
        removeTagForm($collectionHolder, $removeLinkLi);
    });
});
function addTagForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data("prototype");

    
    // get the new index
    var index = $collectionHolder.data("index");

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data("index", index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $("<li></li>").append(newForm);
    $newLinkLi.before($newFormLi);
    addTagFormDeleteLink($newFormLi);
}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormButton = $('<button type="button" class="btn btn-outline-primary my-2">Supprimez une video</button>');
    $tagFormLi.append($removeFormButton);

    $removeFormButton.on("click", function(e) {
        // remove the li for the tag form
        $tagFormLi.remove();
    });
}