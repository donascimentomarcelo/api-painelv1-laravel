/**
   * angular-bootstrap-confirm - Displays a bootstrap confirmation popover when clicking the given element.
   * @version v2.5.1
   * @link https://github.com/mattlewis92/angular-bootstrap-confirm
   * @license MIT
   */
!function(n,t){"object"==typeof exports&&"object"==typeof module?module.exports=t(require("angular"),require("angular-sanitize")):"function"==typeof define&&define.amd?define(["angular","angular-sanitize"],t):"object"==typeof exports?exports.angularBootstrapConfirmModuleName=t(require("angular"),require("angular-sanitize")):n.angularBootstrapConfirmModuleName=t(n.angular,n["angular-sanitize"])}(this,function(n,t){return function(n){function t(o){if(e[o])return e[o].exports;var i=e[o]={exports:{},id:o,loaded:!1};return n[o].call(i.exports,i,i.exports,t),i.loaded=!0,i.exports}var e={};return t.m=n,t.c=e,t.p="",t(0)}([function(n,t,e){"use strict";var o=e(1),i=e(2);e(3),e(1);var a="angular-bootstrap-confirm.html";n.exports=o.module("mwl.confirm",["ngSanitize","ui.bootstrap.position"]).run(["$templateCache",function(n){n.put(a,i)}]).controller("PopoverConfirmCtrl",["$scope","$rootScope","$element","$attrs","$compile","$document","$window","$timeout","$injector","$templateRequest","$parse","$log","$animate","confirmationPopoverDefaults",function(n,t,e,i,a,s,r,l,c,u,m,f,d,p){function v(t,e){var a=i[t];o.isDefined(a)&&(m(a).assign?m(a).assign(n,e):f.warn("Could not set value of "+t+" to "+e+". This is normally because the value is not a variable."))}function b(t,e,i){return o.isDefined(t)?m(t)(n,i):e}function h(){V.then(function(n){var t=w.positionElements(e,n,i.placement||y.defaults.placement,!0);t.top+="px",t.left+="px",n.css(t)})}function $(){var n=i.focusButton||y.defaults.focusButton;n&&V.then(function(t){var e=n+"-button";t[0].getElementsByClassName(e)[0].focus()})}function g(){y.isVisible||b(i.isDisabled,!1)||V.then(function(n){n.css({display:"block"}),z&&d.addClass(n,"in"),h(),$(),y.isVisible=!0,v("isOpen",!0)})}function C(){y.isVisible&&V.then(function(n){z&&d.removeClass(n,"in"),n.css({display:"none"}),y.isVisible=!1,v("isOpen",!1)})}function x(){y.isVisible?C():g()}function B(n){V.then(function(t){!y.isVisible||t[0].contains(n.target)||e[0].contains(n.target)||C()})}var y=this;y.defaults=p,y.$attrs=i;var T=c.has("$uibPosition")?"$uibPosition":"$position",w=c.get(T),P=i.templateUrl||p.templateUrl,k=t.$new(!0),z=y.animation="true"===i.animation||p.animation;k.vm=y;var V=u(P).then(function(n){var t=o.element(n);return t.css("display","none"),a(t)(k),s.find("body").append(t),t});y.isVisible=!1,y.showPopover=g,y.hidePopover=C,y.togglePopover=x,y.onConfirm=function(n){b(i.onConfirm,null,n)},y.onCancel=function(n){b(i.onCancel,null,n)},n.$watch(i.isOpen,function(n){l(function(){n?g():C()})}),e.bind("click",x),r.addEventListener("resize",h),s.bind("click",B),s.bind("touchend",B),n.$on("$destroy",function(){V.then(function(n){n.remove(),e.unbind("click",x),r.removeEventListener("resize",h),s.unbind("click",B),s.unbind("touchend",B),k.$destroy()})})}]).directive("mwlConfirm",function(){return{restrict:"A",controller:"PopoverConfirmCtrl"}}).value("confirmationPopoverDefaults",{confirmText:"Confirm",cancelText:"Cancel",confirmButtonType:"success",cancelButtonType:"default",placement:"top",focusButton:null,templateUrl:a,hideConfirmButton:!1,hideCancelButton:!1,animation:!1}).name},function(t,e){t.exports=n},function(n,t){n.exports='<div\n  class="popover"\n  ng-class="[vm.$attrs.placement || vm.defaults.placement, \'popover-\' + (vm.$attrs.placement || vm.defaults.placement), vm.$attrs.popoverClass || vm.defaults.popoverClass, {fade: vm.animation}]">\n  <div class="popover-arrow arrow"></div>\n  <h3 class="popover-title" ng-bind-html="vm.$attrs.title"></h3>\n  <div class="popover-content">\n    <p ng-bind-html="vm.$attrs.message"></p>\n    <div class="row">\n      <div\n        class="col-xs-6"\n        ng-if="!vm.$attrs.hideConfirmButton && !vm.defaults.hideConfirmButton"\n        ng-class="{\'col-xs-offset-3\': vm.$attrs.hideCancelButton || vm.defaults.hideCancelButton}">\n        <button\n          class="btn btn-block confirm-button"\n          ng-class="\'btn-\' + (vm.$attrs.confirmButtonType || vm.defaults.confirmButtonType)"\n          ng-click="vm.onConfirm(); vm.hidePopover()"\n          ng-bind-html="vm.$attrs.confirmText || vm.defaults.confirmText">\n        </button>\n      </div>\n      <div\n        class="col-xs-6"\n        ng-if="!vm.$attrs.hideCancelButton && !vm.defaults.hideCancelButton"\n        ng-class="{\'col-xs-offset-3\': vm.$attrs.hideConfirmButton || vm.defaults.hideConfirmButton}">\n        <button\n          class="btn btn-block cancel-button"\n          ng-class="\'btn-\' + (vm.$attrs.cancelButtonType || vm.defaults.cancelButtonType)"\n          ng-click="vm.onCancel(); vm.hidePopover()"\n          ng-bind-html="vm.$attrs.cancelText || vm.defaults.cancelText">\n        </button>\n      </div>\n    </div>\n  </div>\n</div>\n'},function(n,e){n.exports=t}])});
//# sourceMappingURL=angular-bootstrap-confirm.min.js.map