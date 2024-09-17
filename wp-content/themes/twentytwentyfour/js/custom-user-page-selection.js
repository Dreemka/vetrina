jQuery(document).ready(function($) {
  function fetchPages(searchQuery) {
      $.ajax({
          url: ajax_object.ajax_url,
          type: 'POST',
          data: {
              action: 'custom_user_page_search',
              search: searchQuery,
              nonce: ajax_object.nonce
          },
          success: function(response) {
              $('#search-results .methodix-method-cards-wrapper').html(response);
          }
      });
  }

  // Изначально загружаем все страницы или результаты поиска, если есть
  var initialSearchQuery = $('#search-input').val();
  fetchPages(initialSearchQuery);

  $('#search-form').on('submit', function(e) {
      e.preventDefault();
      var searchQuery = $('#search-input').val();
      fetchPages(searchQuery);

      // Обновляем URL без перезагрузки страницы
      var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?search=' + encodeURIComponent(searchQuery);
      window.history.pushState({ path: newUrl }, '', newUrl);
  });

  $('#search-input').on('input', function() {
      var searchQuery = $(this).val();
      fetchPages(searchQuery);

      // Обновляем URL без перезагрузки страницы
      var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?search=' + encodeURIComponent(searchQuery);
      window.history.pushState({ path: newUrl }, '', newUrl);
  });
});