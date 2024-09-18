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
      var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?search=' + encodeURIComponent(searchQuery);
      window.history.pushState({ path: newUrl }, '', newUrl);
  };

  function getfilters() {
    return {
        minus: $('#methodix-filter-minus').val(),
        plus: $('#methodix-filter-plus').val(),
        expenses: $('#methodix-filter-expenses').val(),
    };
  }

  function getSearchQuery() {
    return $('#methodix-search-input').val();
  }

  fetchPages(getSearchQuery(), getfilters());

  $('#methodix-search-form').on('submit', function(e) {
      e.preventDefault();
      fetchPages(getSearchQuery(), getfilters());
      historyPath(getSearchQuery());
  });

  $('#methodix-search-input').on('input', function() {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(function() {
          fetchPages(getSearchQuery(), getfilters());
          historyPath(getSearchQuery());
      }, doneTypingInterval);
  });

    // Обработка изменения фильтров
  $('#methodix-filter-minus , #methodix-filter-plus , #methodix-filter-expenses').on('change', function() {
    fetchPages(getSearchQuery(), getfilters());
    historyPath(getSearchQuery());
  });

  // Если пользователь начинает печатать, сбрасываем таймер
  $('#methodix-search-input').on('keydown', function() {
      clearTimeout(typingTimer);
  });

  window.addEventListener("popstate", () => {
    const url = new URL(window.location.href);
    const searchParam = url.searchParams.get("search");
    fetchPages(searchParam, getfilters());
    $('#methodix-search-input').val(searchParam || '');
  });
});