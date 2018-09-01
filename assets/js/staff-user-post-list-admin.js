"use strict";

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

jQuery(document).ready(function ($) {
  if ($('.m-staff-list').length > 0) {
    var _$$sortable;

    $('.m-staff-list').sortable((_$$sortable = {
      axis: 'y',
      cursor: 'move',
      opacity: 0.6
    }, _defineProperty(_$$sortable, "cursor", 'move'), _defineProperty(_$$sortable, "distance", 5), _defineProperty(_$$sortable, "update", function update() {}), _$$sortable));
  }
});
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNvcnQuanMiXSwibmFtZXMiOlsialF1ZXJ5IiwiZG9jdW1lbnQiLCJyZWFkeSIsIiQiLCJsZW5ndGgiLCJzb3J0YWJsZSIsImF4aXMiLCJjdXJzb3IiLCJvcGFjaXR5Il0sIm1hcHBpbmdzIjoiOzs7O0FBQUFBLE1BQU0sQ0FBRUMsUUFBRixDQUFOLENBQW1CQyxLQUFuQixDQUEwQixVQUFVQyxDQUFWLEVBQWM7QUFDdkMsTUFBS0EsQ0FBQyxDQUFFLGVBQUYsQ0FBRCxDQUFxQkMsTUFBckIsR0FBOEIsQ0FBbkMsRUFBdUM7QUFBQTs7QUFDdENELElBQUFBLENBQUMsQ0FBRSxlQUFGLENBQUQsQ0FBcUJFLFFBQXJCO0FBQ0NDLE1BQUFBLElBQUksRUFBRSxHQURQO0FBRUNDLE1BQUFBLE1BQU0sRUFBRSxNQUZUO0FBR0NDLE1BQUFBLE9BQU8sRUFBRTtBQUhWLDhDQUlTLE1BSlQsNENBS1csQ0FMWCwwQ0FNUyxrQkFBVyxDQUFFLENBTnRCO0FBUUE7QUFDRCxDQVhEIiwiZmlsZSI6InN0YWZmLXVzZXItcG9zdC1saXN0LWFkbWluLmpzIiwic291cmNlc0NvbnRlbnQiOlsialF1ZXJ5KCBkb2N1bWVudCApLnJlYWR5KCBmdW5jdGlvbiggJCApIHtcblx0aWYgKCAkKCAnLm0tc3RhZmYtbGlzdCcgKS5sZW5ndGggPiAwICkge1xuXHRcdCQoICcubS1zdGFmZi1saXN0JyApLnNvcnRhYmxlKHtcblx0XHRcdGF4aXM6ICd5Jyxcblx0XHRcdGN1cnNvcjogJ21vdmUnLFxuXHRcdFx0b3BhY2l0eTogMC42LFxuXHRcdFx0Y3Vyc29yOiAnbW92ZScsXG5cdFx0XHRkaXN0YW5jZTogNSxcblx0XHRcdHVwZGF0ZTogZnVuY3Rpb24oKSB7fVxuXHRcdH0pO1xuXHR9XG59KTtcbiJdfQ==
