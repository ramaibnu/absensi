$("body").on("mouseenter", ".tooltips", function () {
  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll(".tooltips")
  );
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    if (!$(tooltipTriggerEl).data(".tooltip")) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    }
  });
});
