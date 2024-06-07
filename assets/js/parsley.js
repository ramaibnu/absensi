$.extend(window.Parsley.options, {
  focus: "first",
  excluded:
    "input[type=button], input[type=submit], input[type=reset], .search, .ignore",
  triggerAfterFailure: "change blur",
  errorsContainer: function (element) {},
  trigger: "change",
  successClass: "is-valid",
  errorClass: "is-invalid",
  classHandler: function (el) {
    return el.$element.closest(".form-group");
  },
  errorsContainer: function (el) {
    return el.$element.closest(".form-group");
  },
  errorsWrapper: '<div class="parsley-error"></div>',
  errorTemplate: "<span></span>",
});

Parsley.on("field:validated", function (el) {
  var elNode = $(el)[0];
  if (elNode && !elNode.isValid()) {
    var requiredValResult = elNode.validationResult.filter(function (vr) {
      return vr.assert.name === "required";
    });
    if (requiredValResult.length > 0) {
      var fieldNode = $(elNode.element);
      var formGroupNode = fieldNode.closest(".form-group");
      var lblNode = formGroupNode.find(".form-label:first");
      if (lblNode.length > 0) {
        var lblText = lblNode.text();
        lblText = lblText.replace(":", "");
        var spanNode = lblNode.find("span");
        if (spanNode.length > 0) {
          lblText = lblText.replace("*", ""); // Remove '*' character
        }
        // Get the element's tag name
        var tagName = fieldNode.prop("tagName").toLowerCase();

        // Determine the error message based on the tag name
        var errorMessage;
        if (tagName === "input") {
          if (fieldNode.attr("type") === "file") {
            errorMessage = lblText + " belum dipilih.";
          } else {
            errorMessage = lblText + " wajib diisi.";
          }
        } else if (tagName === "select") {
          errorMessage = lblText + " wajib dipilih.";
        } else {
          errorMessage = lblText + " wajib diisi.";
        }

        // Change the error message
        var errorNode = formGroupNode.find(
          "div.parsley-error span[class*=parsley-]"
        );
        if (errorNode.length > 0 && errorMessage) {
          errorNode.html(errorMessage);
        }
      }
    }
  }
});

Parsley.addValidator("ktp", {
  validateString: function(value, requirement) {
    return value.length == requirement;
  },
  requirementType: "integer",
  messages: {
    en: "No. KTP harus 16 karakter.",
    id: "No. KTP harus 16 karakter.",
  },
});

Parsley.addValidator("namaPerusahaanMaxLength", {
  validateString: function(value, requirement) {
    return value.length <= requirement;
  },
  requirementType: "integer",
  messages: {
    en: "Nama Perusahaan maksimal %s karakter.",
    id: "Nama Perusahaan maksimal %s karakter.",
  },
});

Parsley.addValidator("alamatMaxLength", {
  validateString: function(value, requirement) {
    return value.length <= requirement;
  },
  requirementType: "integer",
  messages: {
    en: "Alamat maksimal %s karakter.",
    id: "Alamat maksimal %s karakter.",
  },
});

Parsley.addValidator("kodePerusahaanMaxLength", {
  validateString: function(value, requirement) {
    return value.length <= requirement;
  },
  requirementType: "integer",
  messages: {
    en: "Kode Perusahaan maksimal %s karakter.",
    id: "Kode Perusahaan maksimal %s karakter.",
  },
});

Parsley.addValidator("kodeMaxLength", {
  validateString: function(value, requirement) {
    return value.length <= requirement;
  },
  requirementType: "integer",
  messages: {
    en: "Kode maksimal %s karakter.",
    id: "Kode maksimal %s karakter.",
  },
});

Parsley.addValidator("lettersOnly", {
  requirementType: "string",
  validateString: function (value) {
    return !/[0-9!@#$%^&*()_+{}\[\]:;<>,.?~\\`'"//]/.test(value);
  },
  messages: {
    en: "Special characters and numbers are not allowed.",
    id: "Karakter khusus dan angka tidak diperbolehkan.",
  },
});

Parsley.addValidator("numbersOnly", {
  requirementType: "integer",
  validateString: function (value) {
    return !/[a-zA-Z!@#$%^&*()_+{}\[\]:;<>,.?~\\`'"//]/.test(value);
  },
  messages: {
    en: "Special characters and letters are not allowed.",
    id: "Karakter khusus dan huruf tidak diperbolehkan.",
  },
});

Parsley.addValidator("blockSpecial", {
  requirementType: "integer",
  validateString: function (value) {
    return !/[!@#$%^&*()_+{}\[\]:;<>,.?~\\`'"//]/.test(value);
  },
  messages: {
    en: "Special characters are not allowed.",
    id: "Karakter khusus tidak diperbolehkan.",
  },
});

Parsley.addValidator("matchPassword", {
  requirementType: "string",
  validateString: function (value, requirement) {
    // Get the value of the "password" field
    var password = $("#" + requirement).val();

    // Compare the "password" and "confirm password" fields
    return value === password;
  },
  messages: {
    en: "Password does not match.",
    id: "Password tidak cocok.",
  },
});

Parsley.addValidator("sandiMinLength", {
  validateString: function(value, requirement) {
    return value.length >= requirement;
  },
  requirementType: "integer",
  messages: {
    en: "Sandi baru minimal %s karakter.",
    id: "Sandi baru minimal %s karakter.",
  },
});

Parsley.addValidator("konfirmasiMinLength", {
  validateString: function(value, requirement) {
    return value.length >= requirement;
  },
  requirementType: "integer",
  messages: {
    en: "Konfirmasi ulang sandi minimal %s karakter.",
    id: "Konfirmasi ulang sandi minimal %s karakter.",
  },
  group: "ulangSandiGroup",
});

Parsley.addValidator("konfirmasiMatch", {
  validateString: function(value, targetFieldName) {
    // Get the value of the target field directly from the DOM
    var targetValue = document.getElementById(targetFieldName).value;

    // Check if the values match
    return value === targetValue;
  },
  requirementType: "string",  // Use "string" as the requirement type for the target field
  messages: {
    en: "Konfirmasi ulang sandi tidak cocok.",
    id: "Konfirmasi ulang sandi tidak cocok.",
  },
  group: "ulangSandiGroup",
});

Parsley.addValidator("customConfirmPassword", {
  validate: function (value, requirements, instance) {
    var targetFieldName = requirements;
    var targetValue = document.getElementById(targetFieldName).value;

    if (value.length < 6) {
      // Minimum length validation failed
      return false;
    }

    if (value !== targetValue) {
      // Match validation failed
      return false;
    }

    // Both validations passed
    return true;
  },
  messages: {
    en: "Konfirmasi ulang sandi minimal 6 karakter atau tidak cocok.",
    id: "Konfirmasi ulang sandi minimal 6 karakter atau tidak cocok.",
  },
});

Parsley.addValidator('validEmail', {
  validateString: function(value) {
    // Regular expression for validating email addresses
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(value);
  },
messages: {
    en: 'Format email tidak valid.',
    id: 'Format email tidak valid.',
}
});
