$(function () {
  $('.accordion').on('click', function () {
    $(this).next().slideToggle(200);
    //矢印向き変更
    $(this).toggleClass('open', 200);
  }).next().hide();
});
