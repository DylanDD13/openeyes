(function (exports, Util, EventEmitter) {
  function NavBtnPopup(id, $btn, $content) {

    var popup = this;

    // private
    this.id = id;
    this.eventObj = $btn;
    this.useMouseEvents = false;
    this.isGrouped = false; 		// e.g. patient popups
    this.groupController = null;
    this.isFixed = false;
    this.latchable = false;
    this.isLatched = false;
    this.css = {
      active: 'active', 	// hover
      open: 'open' 		// clicked
    };
    init(); // all are initiated but useWrapperEvents modifies the eventObj then re-initiates

    function init() {
      // Events
      popup.eventObj.click(function (e) {
        e.stopPropagation();
        // use $btn class as boolean
        changeContent($btn.hasClass(popup.css.open));
      }).mouseenter(function () {
        if (popup.isLatched) return;
        $btn.addClass(popup.css.active);
        if (popup.useMouseEvents) {
          show();
        }
      }).mouseleave(function () {
        if (popup.isLatched) return;
        $btn.removeClass(popup.css.active);
        if (popup.useMouseEvents) {
          hide();
        }
      });
    }

    /**
     public methods
     **/
    this.init = init;
    this.hide = hide;
    this.useWrapper = useWrapperEvents;
    this.fixed = fixed;
    this.inGroup = inGroup;
    this.show = show;
    this.hide = hide;
    this.latch = latch;
    this.unlatch = unlatch;

    /**
     provide a way for shortcuts to re-assign
     the Events to the DOM wrapper
     **/


    function changeContent(isOpen) {
      if (popup.isFixed) return; // if popup is fixed

      if (popup.latchable) {
        if (popup.isLatched) {
          if (popup.isGrouped) {
            popup.groupController.closeAll();
          }
          popup.unlatch();
        } else {
          if (popup.isGrouped) {
            popup.groupController.closeAll();
          }
          popup.latch()
        }
      } else if (isOpen) {
        popup.hide();
      } else {
        if (popup.isGrouped) {
          popup.groupController.closeAll();
        }
        popup.show();
      }
    }

    function show() {
      $btn.addClass(popup.css.open);
      $content.show();
      if (popup.useMouseEvents && !popup.isFixed) addContentEvents();
    }

    function hide() {
      $btn.removeClass(popup.css.open);
      $content.hide();
    }

    /**
     Enhance $content behaviour for non-touch users
     Allow mouseLeave to close $content popup
     **/
    function addContentEvents() {
      $content.mouseenter(function () {
        $(this).off('mouseenter'); // clean up
        $(this).mouseleave(function () {
          $(this).off('mouseleave'); // clean up
          popup.hide();
        });
      });
    }

    /**
     DOM structure for the Shortcuts dropdown list is different
     Need to shift the events to the wrapper DOM rather than the $btn
     **/
    function useWrapperEvents(DOMwrapper) {
      popup.eventObj.off('click mouseenter mouseleave');
      popup.eventObj = DOMwrapper;
      popup.css.open = popup.css.active; // wrap only has 1 class
      popup.useMouseEvents = true;
      popup.init(); // re initiate with new eventObj
    }

    /**
     Activity Panel needs to be fixable when the browsers is wide enough
     (but not in oescape mode)
     **/
    function fixed(b) {
      popup.isFixed = b;
      if (b) {
        $content.off('mouseenter mouseleave');
        popup.show();
      } else {
        popup.hide();
      }
    }

    function latch() {
      if (popup.groupController) {
        popup.groupController.lockAll();
      }
      popup.isLatched = true;
      popup.show();
      $content.off('mouseenter mouseleave');
    }

    function unlatch() {
      if (popup.groupController) {
        popup.groupController.unlockAll();
      }
      popup.isLatched = false;
      popup.hide();
      $content.on('mouseenter mouseleave');
      $btn.removeClass(popup.css.active);
    }

    /**
     Group popups to stop overlapping
     **/
    function inGroup(controller) {
      popup.isGrouped = true;
      popup.groupController = controller;
    }
  }

  Util.inherits(EventEmitter, NavBtnPopup);

  exports.NavBtnPopup = NavBtnPopup;
}(OpenEyes.UI, OpenEyes.Util, OpenEyes.Util.EventEmitter));