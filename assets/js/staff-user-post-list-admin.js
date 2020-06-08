;(function($) {
"use strict";

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

jQuery(document).ready(function ($) {
  if (0 < $('.m-staff-list').length) {
    var _$$sortable;

    $('.m-staff-list').sortable((_$$sortable = {
      axis: 'y',
      cursor: 'move',
      opacity: 0.6
    }, _defineProperty(_$$sortable, "cursor", 'move'), _defineProperty(_$$sortable, "distance", 5), _defineProperty(_$$sortable, "update", function update() {}), _$$sortable));
  }
});
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNvcnQuanMiXSwibmFtZXMiOlsialF1ZXJ5IiwiZG9jdW1lbnQiLCJyZWFkeSIsIiQiLCJsZW5ndGgiLCJzb3J0YWJsZSIsImF4aXMiLCJjdXJzb3IiLCJvcGFjaXR5Il0sIm1hcHBpbmdzIjoiOzs7O0FBQUFBLE1BQU0sQ0FBRUMsUUFBRixDQUFOLENBQW1CQyxLQUFuQixDQUEwQixVQUFVQyxDQUFWLEVBQWM7QUFDdkMsTUFBSyxJQUFJQSxDQUFDLENBQUUsZUFBRixDQUFELENBQXFCQyxNQUE5QixFQUF1QztBQUFBOztBQUN0Q0QsSUFBQUEsQ0FBQyxDQUFFLGVBQUYsQ0FBRCxDQUFxQkUsUUFBckI7QUFDQ0MsTUFBQUEsSUFBSSxFQUFFLEdBRFA7QUFFQ0MsTUFBQUEsTUFBTSxFQUFFLE1BRlQ7QUFHQ0MsTUFBQUEsT0FBTyxFQUFFO0FBSFYsOENBSVMsTUFKVCw0Q0FLVyxDQUxYLDBDQU1TLGtCQUFXLENBQUUsQ0FOdEI7QUFRQTtBQUNELENBWEQiLCJmaWxlIjoic3RhZmYtdXNlci1wb3N0LWxpc3QtYWRtaW4uanMiLCJzb3VyY2VzQ29udGVudCI6WyJqUXVlcnkoIGRvY3VtZW50ICkucmVhZHkoIGZ1bmN0aW9uKCAkICkge1xuXHRpZiAoIDAgPCAkKCAnLm0tc3RhZmYtbGlzdCcgKS5sZW5ndGggKSB7XG5cdFx0JCggJy5tLXN0YWZmLWxpc3QnICkuc29ydGFibGUoe1xuXHRcdFx0YXhpczogJ3knLFxuXHRcdFx0Y3Vyc29yOiAnbW92ZScsXG5cdFx0XHRvcGFjaXR5OiAwLjYsXG5cdFx0XHRjdXJzb3I6ICdtb3ZlJyxcblx0XHRcdGRpc3RhbmNlOiA1LFxuXHRcdFx0dXBkYXRlOiBmdW5jdGlvbigpIHt9XG5cdFx0fSk7XG5cdH1cbn0pO1xuIl19
}(jQuery));
