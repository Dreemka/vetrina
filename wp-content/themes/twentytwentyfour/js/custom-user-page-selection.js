jQuery(document).ready(function($) {
  let typingTimer = null;
  let doneTypingInterval = 1000;
  var methodixFiltersResult = {};
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
              filters: JSON.stringify(filters),
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

  function getfilters(target , value) {
    let filter = false;
    if (target) {
      filter = target.getAttribute('name-filter');
      methodixFiltersResult[filter] = target.value || value;
    }

    return methodixFiltersResult;
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
  $(`#methodix-filter-minus,
    #methodix-filter-plus,
    #methodix-filter-expenses,
    #methodix-filter-type_model,
    #methodix-filter-chislennost,
    #methodix-filter-harakteristiki,
    #methodix-filter-podhody,
    #methodix-filter-artefakty,
    #methodix-filter-dokumentacija,
    #methodix-filter-bjudzhet,
    #methodix-filter-sroki
    `).on('change', function(e) {
    fetchPages(getSearchQuery(), getfilters(e.target));
    historyPath(getSearchQuery());
  });


  document.querySelectorAll('md-filter-chip').forEach(function(chip) {
    chip.addEventListener('click', function(e) {
        // Предотвращаем клик по чекбоксу, чтобы не было двойного срабатывания
        if (e.target.tagName.toLowerCase() === 'input') {
            return;
        }
  
        const checkbox = chip.querySelector('input[type="checkbox"]');
        checkbox.checked = !checkbox.checked; // Переключаем состояние чекбокса
  
        // Получаем все выбранные чекбоксы
        let selectedChips = [];

        let getAttribute = e.target.getAttribute('name-filter');
        let getAttributeLabel = e.target.getAttribute('label');

        document.querySelectorAll('[label="'+ getAttributeLabel +'"][name-filter="'+ getAttribute +'"]').forEach(function(chipSelect) {
          chipSelect.selected = checkbox.checked;
          chipSelect.querySelector('input').checked = checkbox.checked;
        });

        document.querySelectorAll('input[name="'+ getAttribute +'"]:checked').forEach(function(checkedCheckbox) {
            selectedChips.push(checkedCheckbox.value);
            selectedChips = [...new Set(selectedChips)];
        });
  
        fetchPages(getSearchQuery(), getfilters(e.target , selectedChips.length ? selectedChips : null));
        historyPath(getSearchQuery());
    });
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

let openCloseRightPanel = false;

function closeRightPanel() {
  let closeButton = document.querySelector('.methodix-close-button');
  let openButton = document.querySelector('.methodix-open-right-panel-button');
  let rightPanel = document.querySelector('.methodix-right-panel-filters');
  let backgroundRightPanel = document.querySelector('.methodix-background-right-panel');
  let methodixLeftSideBarWrapper = document.querySelector('.methodix-left-side-bar-wrapper');

  if (backgroundRightPanel) {
    backgroundRightPanel.addEventListener('click', () => {
      openCloseRightPanel = false;
      rightPanel.classList.remove('methodix-open-right-panel');
      backgroundRightPanel.style = 'display: none';
      methodixLeftSideBarWrapper.style = 'background: none';
    });
  }

  if (closeButton) {
    closeButton.addEventListener('click', () => {
      openCloseRightPanel = false;
      rightPanel.classList.remove('methodix-open-right-panel');
      backgroundRightPanel.style = 'display: none';
      methodixLeftSideBarWrapper.style = 'background: none';
    });
  }

  if (openButton) {
    openButton.addEventListener('click', () => {
      openCloseRightPanel = true;
      rightPanel.classList.add('methodix-open-right-panel');
      backgroundRightPanel.style = 'display: block';
      methodixLeftSideBarWrapper.style = 'background: rgba(0, 0, 0, 0.16);';
    });
  }

}

closeRightPanel();


