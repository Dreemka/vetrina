(function(wp) {
  wp.domReady(function() {
      var registerPlugin = wp.plugins.registerPlugin;
      var PluginSidebar = wp.editPost.PluginSidebar;
      var PanelBody = wp.components.PanelBody;
      var PanelRow = wp.components.PanelRow;
      var Badge = wp.components.Badge;
      var el = wp.element.createElement;

      var CustomBadge = function() {
          return el(
              wp.element.Fragment,
              null,
              el(
                  PluginSidebar,
                  {
                      name: 'custom-badge-sidebar',
                      title: 'Custom Badge',
                      icon: 'admin-site'
                  },
                  el(
                      PanelBody,
                      { title: 'Badge Settings' },
                      el(
                          PanelRow,
                          null,
                          el(Badge, { isSecondary: true }, 'My Custom Badge')
                      )
                  )
              )
          );
      };

      registerPlugin('custom-badge', {
          render: CustomBadge
      });
  });
})(window.wp);