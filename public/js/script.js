$(function () {
  $('.accordion').on('click', function () {
    $(this).next().slideToggle(200);
    //矢印向き変更
    $(this).toggleClass('open', 200);
  }).next().hide();
});

$('.js-modal-open').on('click', function () {
  $('.js-modal').fadeIn();
  var post_id = $(this).attr('post_id');
  var post = $(this).attr('post');
  $('.modal_id').val(post_id);
  $('.modal_post').text(post);
  return false;
});

$('.js-modal-close').on('click', function () {
  $('.js-modal').fadeOut();
  return false;
});
