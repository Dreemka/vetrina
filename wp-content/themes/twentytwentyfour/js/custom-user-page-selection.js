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




let openCloseRightPanel = false;
let methodixLeftSideBarWrapper = document.querySelector('.methodix-left-side-bar-wrapper');

function rightPanelHendler(rightPanelClass , nameClick) {
  
  let rightPanel = document.querySelector(rightPanelClass);
  let backgroundRightPanel = document.querySelector('.methodix-background-right-panel');
  

  if (backgroundRightPanel) {
    backgroundRightPanel.addEventListener('click', () => {
      openCloseRightPanel = false;
      rightPanel.classList.remove('methodix-open-right-panel');
      backgroundRightPanel.style = 'display: none';
      methodixLeftSideBarWrapper.style = 'background: none';
    });
  }

  window[nameClick + 'Close'] = function() {
    openCloseRightPanel = false;
    rightPanel.classList.remove('methodix-open-right-panel');
    backgroundRightPanel.style = 'display: none';
    methodixLeftSideBarWrapper.style = 'background: none';
  }

  window[nameClick] = function() {
    openCloseRightPanel = true;
    rightPanel.classList.add('methodix-open-right-panel');
    backgroundRightPanel.style = 'display: block';
    methodixLeftSideBarWrapper.style = 'background: rgba(0, 0, 0, 0.16);';
  }

  window[nameClick] = function() {
    openCloseRightPanel = true;
    rightPanel.classList.add('methodix-open-right-panel');
    backgroundRightPanel.style = 'display: block';
    methodixLeftSideBarWrapper.style = 'background: rgba(0, 0, 0, 0.16);';
  }
}


rightPanelHendler('.methodix-right-panel-methods-list' , 'handleOpenMethodsListRightPanelClick');
rightPanelHendler('.methodix-right-panel-filters'  , 'handleOpenRightPanelFilters');

let choiseCards = [];
const comparisonButtonWrapper = document.querySelector('.methodix-comparison-button-wrapper');

window.handleCardComparisonChoiseClick = function(e , id) {
  const element = e.currentTarget;
  const exists = choiseCards.some(card => card.id === id);
  
  choiseCards = choiseCards.filter(card => card.id !== id);
  element.classList.remove('choise-card-active');
  if (choiseCards.length < 1) {
    comparisonButtonWrapper.style = 'display: none';
  }
  if (choiseCards.length === 1) {
    comparisonButtonWrapper.classList.add('methodix-comparison-button-wrapper-no-active');
  }
  if (exists) return;

  choiseCards.push({
    id: id,
    e: element,
  });

  if (choiseCards.length === 1) {
    comparisonButtonWrapper.style = 'display: flex';
    comparisonButtonWrapper.classList.add('methodix-comparison-button-wrapper-no-active');
  } else {
    comparisonButtonWrapper.classList.remove('methodix-comparison-button-wrapper-no-active');
  }

  element.classList.add('choise-card-active');
}

window.handleCardCloseClick = function() {
  choiseCards = [];
  comparisonButtonWrapper.style = 'display: none';
  document.querySelectorAll('.methodix-comparison-chip').forEach(chip => chip.classList.remove('choise-card-active'));
  $('#search-results-comparison .methodix-comparison-cards-wrapper').hide();
  $('.methodix-main-content-block').css('overflow-y', 'scroll');
  methodixLeftSideBarWrapper.style = 'none';
};

function fetchPageCardWindow(id) {

  document.getElementById('loader-comparison').style.visibility = 'visible';
  $.ajax({
      url: ajax_object.ajax_url,
      type: 'POST',
      data: {
          action: 'page_method_in_window',
          post_id: id,
          nonce: ajax_object.nonce,
      },
      success: function(response) {
          $('#search-results-comparison .methodix-comparison-cards-wrapper').html(response);
      },
      complete: function() {
          document.getElementById('loader-comparison').style.visibility = 'hidden';
          $('#search-results-comparison .methodix-comparison-cards-wrapper').show();
      }
  });
}


function fetchComparisonWindow(choiseCards) {

  document.getElementById('loader-comparison').style.visibility = 'visible';
  $.ajax({
      url: ajax_object.ajax_url,
      type: 'POST',
      data: {
          action: 'comparison_methods_window',
          choiseCards: JSON.stringify(choiseCards),
          nonce: ajax_object.nonce
      },
      success: function(response) {
          $('#search-results-comparison .methodix-comparison-cards-wrapper').html(response);
      },
      complete: function() {
          document.getElementById('loader-comparison').style.visibility = 'hidden';
          $('#search-results-comparison .methodix-comparison-cards-wrapper').show();
      }
  });
}


window.handleCardOpenClick = function(event , id) {
  console.log(88);
  console.log(id);
  document.querySelectorAll('[id*="mathodix-method-link"]').forEach(link => link.classList.remove('choise-card-active'));
  document.getElementById('mathodix-method-link-' + id).classList.add('choise-card-active');

  fetchPageCardWindow(id);
  $('.methodix-main-content-block').css('overflow', 'hidden');
  methodixLeftSideBarWrapper.style = 'background: rgba(0, 0, 0, 0.16);';
}

window.handleCardComparisonClick = function() {
  fetchComparisonWindow(choiseCards);
  $('.methodix-main-content-block').css('overflow', 'hidden');
  methodixLeftSideBarWrapper.style = 'background: rgba(0, 0, 0, 0.16);';
}

function updateTopPosition() {
  var scrollTop = $('main').scrollTop();
  $('.methodix-comparison-cards-wrapper').css('top', scrollTop + 'px');
  $('#loader-comparison').css('top', scrollTop + 'px');
}

// Обновляем позицию top при загрузке страницы
updateTopPosition();

// Обновляем позицию top при прокрутке окна
$('main').scroll(function() {
  updateTopPosition();
});

});
