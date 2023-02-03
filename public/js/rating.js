$(document).ready(function(){

    /* 1. Visualizing things on Hover - See next part for action on click */
    $('#stars li').on('mouseover', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

        // Now highlight all the stars that's not after the current hovered star
        $(this).parent().children('li.star').each(function(e){
            if (e < onStar) {
                $(this).addClass('hover');
            }
            else {
                $(this).removeClass('hover');
            }
        });

    }).on('mouseout', function(){
        $(this).parent().children('li.star').each(function(e){
            $(this).removeClass('hover');
        });
    });


    /* 2. Action to perform on click */
    $('#stars li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');

        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }

        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }

        // JUST RESPONSE (Not needed)
        var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
        var msg = "";
        if (ratingValue > 1) {
            msg = "Thanks! You rated this " + ratingValue + " stars.";
        }
        else {
            msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
        }
        responseMessage(msg);

    });


});


function responseMessage(msg) {
    $('.success-box').fadeIn(200);
    $('.success-box div.text-message').html("<span>" + msg + "</span>");
}


// --- AJAX REVIEWS --- //

/**
 * Ajax header for CSRF token validation
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/**
 * Ajax review request
 */
$('#rating-form').on('submit',function(e){
    e.preventDefault();

    let value = $('#stars .star.selected').length;
    if (value === 0) {
        alert('You must express your vote to submit a review.');
        return false;
    }
    renderSpinner();
    let description = $('#rating-description').val();
    let userId = $('#user-id').val();
    let marketplaceId = $('#marketplace-id').val();

    $.ajax({
        url: "http://localhost:8000/create-review",
        type:"POST",
        data:{
            value:value,
            description:description,
            userId: userId,
            marketplaceId: marketplaceId
        },
        success: function(response) {
            $('#no-reviews').slideToggle();
            removeReviewForm();
            renderReview();
        },
        error: function(response) {
            alert('An error has occurred sending your review. Please try again.');
        },
    });
});

/**
 * Render review
 */
function renderReview()
{
    $('#reviews').load('/ajaxReview', function () {
        $('#reviews').hide().fadeIn('slow');
    });
}

/**
 * Remove review form
 */
function removeReviewForm()
{
    $('#form-review').fadeOut('slow', function () {
        $(this).remove();
        $('#your-review-title').remove();
    });
}

function renderSpinner()
{
    $('#review-spinner').show();
}
