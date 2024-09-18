jQuery(document).ready(function($) {
  let typingTimer = null;
  let doneTypingInterval = 1000;
  function fetchPages(searchQuery , filters) {
      // Показываем лоадер
      $('#loader').show();
      $('#search-results .methodix-method-cards-wrapper').hide();

      $.ajax({
          url: ajax_object.ajax_url,
          type: 'POST',
          data: {
              action: 'custom_user_page_search',
              search: searchQuery,
              filters: filters,
              nonce: ajax_object.nonce
          },
          success: function(response) {
              $('#search-results .methodix-method-cards-wrapper').html(response);
          },
          complete: function() {
              // Скрываем лоадер и показываем результаты
              $('#loader').hide();
              $('#search-results .methodix-method-cards-wrapper').show();
          }
      });
  }
  function historyPath(searchQuery) {
      // Обновляем URL без перезагрузки страницы
      var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?search=' + encodeURIComponent(searchQuery);
      window.history.pushState({ path: newUrl }, '', newUrl);
  };

  // Изначально загружаем все страницы или результаты поиска, если есть
  var initialSearchQuery = $('#methodix-search-input').val();
  var initialFilters = {
      minus: $('#methodix-filter-minus').val()
  };
  fetchPages(initialSearchQuery, initialFilters);

  $('#methodix-search-form').on('submit', function(e) {
      e.preventDefault();
      var searchQuery = $('#methodix-search-input').val();
      var filters = {
          minus: $('#methodix-filter-minus').val()
      };
      fetchPages(searchQuery, filters);

      // Обновляем URL без перезагрузки страницы
      historyPath(searchQuery);
  });

  $('#methodix-search-input').on('input', function() {
      var searchQuery = $(this).val();
      var filters = {
          minus: $('#methodix-filter-minus').val()
      };
      clearTimeout(typingTimer);
      typingTimer = setTimeout(function() {
          fetchPages(searchQuery, filters);
          historyPath(searchQuery);
      }, doneTypingInterval);
  });

    // Обработка изменения фильтров
  $('#methodix-filter-minus').on('change', function() {
    var searchQuery = $('#methodix-search-input').val();
    var filters = {
        minus: $('#methodix-filter-minus').val()
    };
    fetchPages(searchQuery, filters);

    // Обновляем URL без перезагрузки страницы
    historyPath(searchQuery);
  });

  // Если пользователь начинает печатать, сбрасываем таймер
  $('#methodix-search-input').on('keydown', function() {
      clearTimeout(typingTimer);
  });
});