/*global $ */
'use strict';

$('html').addClass('js');

// Show/Hide main menu
$('.header__nav')
  .before('<button id="hamburger" type="button"><span class="visually-hidden">Navigation</span></button>')
  .toggle();
$('#hamburger').on('click', function () {
  $(this).toggleClass('open');
  $('.header__nav').toggle('easing');
});

$(() => {
  // totop init
  const $btn = $('#gotop');
  const $link = $('#gotop a');
  $link.attr('title', $link.text());
  $link.html(
    '<svg width="24px" height="24px" viewBox="1 -6 524 524" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M460 321L426 355 262 192 98 355 64 321 262 125 460 321Z"></path></svg>',
  );
  $btn.css({
    width: '32px',
    height: '32px',
    padding: '3px 0',
  });

  // totop scroll
  $(window).scroll(function () {
    if ($(this).scrollTop() === 0) {
      $('#gotop').fadeOut();
    } else {
      $('#gotop').fadeIn();
    }
  });
  $('#gotop').on('click', (e) => {
    $('body,html').animate(
      {
        scrollTop: 0,
      },
      800,
    );
    e.preventDefault();
  });

  // scroll comment preview if present
  document.getElementById('pr')?.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'nearest' }); // totop scroll

  // Add specific .wide-display class to paragraph with media inside, figure and video
  $(
    '.post-content p a img, .post-content figure a img, .post-excerpt p a img, .post-excerpt figure a img, .content-info__cat-desc p a img, .content-info__cat-desc figure a img',
  ).each(function () {
    // Scheme = p a (for full-size media) img (for thumbnail-size media)
    const src = $(this).attr('src');
    let cls = 'wide-media';
    if (src.indexOf('http://') !== 0 && src.indexOf('https://') !== 0) {
      cls = `${cls} local-media`;
    }
    $(this).parent().parent().addClass(cls);
  });
  $('.post-content video, .post-excerpt video').each(function () {
    $(this).addClass('wide-media');
  });

  // Add specific style if first local media is used in post header
  if ($('.media-title')) {
    //$('.post-content .local-media:first-child, .post-excerpt .local-media:first-child').css('display', 'none');
  }
  if ($('.media-cat-title')) {
    //$('.content-info__cat-desc .local-media:first-child').css('display', 'none');
  }
});
