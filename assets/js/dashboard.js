$(document).ready(function () {
  $(`.mainChart`).LoadingOverlay("show");
  // Chart
  let charts = {};
  
  function year() {
    let currentDate = new Date();

    let currentYear = currentDate.getFullYear();

    return currentYear;
  }

  function createChart(
    chartPosition,
    chartData,
    chartSideTitle,
    chartName,
    chartID
  ) {
    let options;
    if (chartPosition == "horizontal") {
      options = {
        chart: {
          height: "auto",
          type: "bar",
        },
        plotOptions: {
          bar: {
            horizontal: true,
            barHeight: "100%",
            dataLabels: {
              position: "top",
            },
          },
        },
        dataLabels: {
          enabled: true,
        },
        stroke: {
          show: true,
          width: 2,
          colors: ["transparent"],
        },
        series: [
          {
            name: "Jumlah Karyawan ",
            data: chartData,
          },
        ],
        noData: {
          text: "Data tidak ditemukan...",
        },
        xaxis: {
          title: {
            text: "Jumlah Karyawan",
          },
        },
        yaxis: {
          title: {
            text: chartSideTitle,
          },
        },
        fill: {
          opacity: 1,
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + " Orang";
            },
          },
        },
      };
    } else {
      options = {
        chart: {
          height: "auto",
          type: "bar",
        },
        plotOptions: {
          bar: {
            barHeight: "100%",
            dataLabels: {
              position: "top",
            },
          },
        },
        dataLabels: {
          enabled: true,
        },
        stroke: {
          show: true,
          width: 2,
          colors: ["transparent"],
        },
        series: [
          {
            name: "Jumlah Karyawan ",
            data: chartData,
          },
        ],
        noData: {
          text: "Data tidak ditemukan...",
        },
        yaxis: {
          title: {
            text: chartSideTitle,
          },
        },
        fill: {
          opacity: 1,
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + " Orang";
            },
          },
        },
      };
    }
    charts[chartName] = new ApexCharts(
      document.querySelector(`#${chartID}`),
      options
    );
    charts[chartName].render();
    $(`#${chartName}`).LoadingOverlay("hide");
  }

  function destroyChart(chartName) {
    if (charts[chartName]) {
      charts[chartName].destroy();
      delete charts[chartName];
    }
  }

  function fetchData(url, parameter = null) {
    return new Promise((resolve, reject) => {
      if (parameter != null) {
        $.getJSON(url, parameter)
          .done((response) => resolve(response))
          .fail((error) => reject(error));
      } else {
        $.getJSON(url)
          .done((response) => resolve(response))
          .fail((error) => reject(error));
      }
    });
  }

  function generateChart(
    chartURL,
    chartPosition,
    chartSideTitle,
    chartName,
    chartID,
    chartParameter = null
  ) {
    if (chartParameter == null) {
      $.getJSON(chartURL, function (data) {
        createChart(chartPosition, data, chartSideTitle, chartName, chartID);
      });
    } else {
      $.getJSON(chartURL, chartParameter, function (data) {
        createChart(chartPosition, data, chartSideTitle, chartName, chartID);
      });
    }
  }

  function allChart(parameter = null, status = null) {
    let horizontal = "horizontal";
    let vertical = "vertical";

    // Chart Perusahaan
    let perusahaanUrl = site_url + "Dashboard_api/chartPerusahaan";
    let perusahaanTitle = "Perusahaan";
    let perusahaanName = "chartPerusahaan";
    let perusahaanID = "bar-chart-1";
    if (status != null) {
      destroyChart(perusahaanName);
      generateChart(
        perusahaanUrl,
        horizontal,
        perusahaanTitle,
        perusahaanName,
        perusahaanID
      );
    } else {
      generateChart(
        perusahaanUrl,
        horizontal,
        perusahaanTitle,
        perusahaanName,
        perusahaanID
      );
    }

    // Chart Perbandingan
    let perbandinganUrl = site_url + "Dashboard_api/chartPerbandingan";
    let perbandinganTitle = "Karyawan Keluar";
    let perbandinganName = "chartPerbandingan";
    let perbandinganID = "bar-chart-8";
    if (parameter != null && status != null) {
      $("#perbandinganTahun").text(parameter.tahun);
      destroyChart(perbandinganName);
      generateChart(perbandinganUrl, vertical, perbandinganTitle, perbandinganName, perbandinganID, parameter);
    } else {
      generateChart(perbandinganUrl, vertical, perbandinganTitle, perbandinganName, perbandinganID);
    }

    // Chart Jenis Kelamin
    let jenisKelaminUrl = site_url + "Dashboard_api/chartJenisKelamin";
    let jenisKelaminTitle = "Jenis Kelamin";
    let jenisKelaminName = "chartJenisKelamin";
    let jenisKelaminID = "bar-chart-2";
    if (status != null) {
      destroyChart(jenisKelaminName);
      generateChart(
        jenisKelaminUrl,
        vertical,
        jenisKelaminTitle,
        jenisKelaminName,
        jenisKelaminID
      );
    } else {
      generateChart(
        jenisKelaminUrl,
        vertical,
        jenisKelaminTitle,
        jenisKelaminName,
        jenisKelaminID
      );
    }

    // Chart Lokasi Penerimaan
    let lokasiUrl = site_url + "Dashboard_api/chartLokasi";
    let lokasiTitle = "Lokasi Penerimaan";
    let lokasiName = "chartLokasiPenerimaan";
    let lokasiID = "bar-chart-3";
    if (status != null) {
      destroyChart(lokasiName);
      generateChart(lokasiUrl, vertical, lokasiTitle, lokasiName, lokasiID);
    } else {
      generateChart(lokasiUrl, vertical, lokasiTitle, lokasiName, lokasiID);
    }

    // Chart Residence
    let residenceUrl = site_url + "Dashboard_api/chartResidence";
    let residenceTitle = "Residence";
    let residenceName = "chartResidence";
    let residenceID = "bar-chart-6";
    if (status != null) {
      destroyChart(residenceName);
      generateChart(
        residenceUrl,
        vertical,
        residenceTitle,
        residenceName,
        residenceID
      );
    } else {
      generateChart(
        residenceUrl,
        vertical,
        residenceTitle,
        residenceName,
        residenceID
      );
    }

    // Chart Sertifikasi
    let sertifikasiUrl = site_url + "Dashboard_api/chartSertifikasi";
    let sertifikasiTitle = "Sertifikasi";
    let sertifikasiName = "chartSertifikasi";
    let sertifikasiID = "bar-chart-7";
    if (status != null) {
      destroyChart(sertifikasiName);
      generateChart(
        sertifikasiUrl,
        vertical,
        sertifikasiTitle,
        sertifikasiName,
        sertifikasiID
      );
    } else {
      generateChart(
        sertifikasiUrl,
        vertical,
        sertifikasiTitle,
        sertifikasiName,
        sertifikasiID
      );
    }

    // Chart Klasifikasi
    let klasifikasiUrl = site_url + "Dashboard_api/chartKlasifikasi";
    let klasifikasiTitle = "Klasifikasi";
    let klasifikasiName = "chartKlasifikasi";
    let klasifikasiID = "bar-chart-4";
    if (status != null) {
      destroyChart(klasifikasiName);
      generateChart(
        klasifikasiUrl,
        vertical,
        klasifikasiTitle,
        klasifikasiName,
        klasifikasiID
      );
    } else {
      generateChart(
        klasifikasiUrl,
        vertical,
        klasifikasiTitle,
        klasifikasiName,
        klasifikasiID
      );
    }

    // Chart Pendidikan
    let pendidikanUrl = site_url + "Dashboard_api/chartPendidikan";
    let pendidikanTitle = "Pendidikan";
    let pendidikanName = "chartPendidikan";
    let pendidikanID = "bar-chart-5";
    if (status != null) {
      destroyChart(pendidikanName);
      generateChart(
        pendidikanUrl,
        vertical,
        pendidikanTitle,
        pendidikanName,
        pendidikanID
      );
    } else {
      generateChart(
        pendidikanUrl,
        vertical,
        pendidikanTitle,
        pendidikanName,
        pendidikanID
      );
    }
  }
  allChart();

  // Select Searchable
  $("#perDetLgrAktif").select2({
    theme: "bootstrap4",
    dropdownParent: $("#mdlDetLanggarAktif"),
  });

  $("#perusahaanFilter").select2({
    theme: "bootstrap4",
    dropdownParent: $("#filterDashboard"),
  });

  $("#tipeFilter").select2({
    theme: "bootstrap4",
    dropdownParent: $("#filterDashboard"),
  });

  $("#tipeFilter2").select2({
    theme: "bootstrap4",
    dropdownParent: $("#filterDashboard"),
  });

  $("#tahun").select2({
    theme: "bootstrap4",
    dropdownParent: $("#filterDashboard"),
  });

  $("#jenisData").select2({
    theme: "bootstrap4",
    dropdownParent: $("#downloadDataKaryawan"),
  });

  $("#jenisData2").select2({
    theme: "bootstrap4",
    dropdownParent: $("#downloadDataPelanggaran"),
  });

  $("#perusahaan").select2({
    theme: "bootstrap4",
    dropdownParent: $("#downloadDataKaryawan"),
  });

  // Click
  $("#detLanggar").click(function () {
    let prs = $("#perDetLgrAktif").val();

    $.LoadingOverlay("show");
    $("#mdlDetLanggarAktif").modal("show");
    $("#tbLanggarAktif").load(
      site_url + "Dashboard_api/data_langgar_aktif/" + prs
    );
  });

  // Change
  $("#perusahaanFilter").change(function () {
    let id = $(this).val();
    let selectedText = $(this).find(":selected").text();

    if (id == "" || id == "0") {
      if (id == "0") {
        $("#tahunField").removeClass("d-none");
        $("#tahun").attr("required", true).val(year()).trigger("change");
      } else {
        $("#tahunField").addClass("d-none");
        $("#tahun").removeAttr("required").val("").trigger("change");
      }
      $("#tipeData").addClass("d-none");
      $("#tipeData2").addClass("d-none");
      $("#tipeFilter").removeAttr("required").val("").trigger("change");
      $("#tipeFilter2").removeAttr("required").val("").trigger("change");
    } else {
      if (selectedText == "PT INDEXIM COALINDO") {
        $("#tahunField").removeClass("d-none");
        $("#tahun").attr("required", true).val(year()).trigger("change");
        $("#tipeData").removeClass("d-none");
        $("#tipeData2").addClass("d-none");
        $("#tipeFilter").attr("required", true).val("0").trigger("change");
        $("#tipeFilter2").removeAttr("required").val("").trigger("change");
      } else {
        if (selectedText == "PT UNGGUL DINAMIKA UTAMA" || selectedText == "PT PELAYARAN GANESHA LAUTJAYA") {
          $("#tahunField").removeClass("d-none");
          $("#tahun").attr("required", true).val(year()).trigger("change");
        } else {
          $("#tahunField").addClass("d-none");
          $("#tahun").removeAttr("required").val("").trigger("change");
        }
        $("#tipeData").addClass("d-none");
        $("#tipeData2").removeClass("d-none");
        $("#tipeFilter").removeAttr("required").val("").trigger("change");
        $("#tipeFilter2").attr("required", true).val("0").trigger("change");
      }
    }
  });

  $("#perDetLgrAktif").change(function () {
    let prs = $("#perDetLgrAktif").val();

    $.LoadingOverlay("show");
    $("#tbLanggarAktif").empty();
    $("#tbLanggarAktif").load(
      site_url + "Dashboard_api/data_langgar_aktif/" + prs
    );
  });

  $("#jenisData").change(function () {
    let jenisData = $(this).val();

    if (jenisData == "AKTIF") {
      $("#perusahaan").attr("required", true);
      $("#jenisPerusahaan").removeClass("d-none");
    } else {
      $("#perusahaan").val("").trigger("change");
      $("#perusahaan").removeAttr("required");
      $("#jenisPerusahaan").addClass("d-none");
    }
  });

  // Submit
  var formFilter = $("#filterData").serialize();
  $("#filterData").submit(function (event) {
    event.preventDefault();
    var checkForm = $(this).serialize();
    if (formFilter != checkForm) {
      $(`.mainChart`).LoadingOverlay("show");
      let perusahaan = $("#perusahaanFilter").val();
      let perusahaanText = $("#perusahaanFilter").find(":selected").text();
      let tipeDataChart;

      if (perusahaanText == "PT INDEXIM COALINDO") {
        $("#chartKaryawanKeluar").removeClass("d-none");
        tipeDataChart = $("#tipeFilter").val();
      } else {
        if (perusahaanText == "SEMUA PERUSAHAAN(ALL DATA)" || perusahaanText == "PT UNGGUL DINAMIKA UTAMA" || perusahaanText == "PT PELAYARAN GANESHA LAUTJAYA") {
          $("#chartKaryawanKeluar").removeClass("d-none");
        } else {
          $("#chartKaryawanKeluar").addClass("d-none");
        }
        tipeDataChart = $("#tipeFilter2").val();
      }

      let parameterData = {
        auth: perusahaan,
        tipe: tipeDataChart,
      };

      let tahun = $("#tahun").val();

      let parameterPerbandingan = {
        auth: perusahaan,
        tahun: tahun,
      };

      let countUrl = site_url + "Dashboard_api/countData";
      fetchData(countUrl, parameterData)
        .then((data) => {
          if ($.isEmptyObject(data.totalPerusahaan)) {
            $("#jumlahPerusahaan").text(data.totalPerusahaan);
          } else {
            $("#jumlahPerusahaan").text("0");
          }
          if ($.isEmptyObject(data.totalPelanggaran)) {
            $("#jumlahPelanggaran").text(data.totalPelanggaran);
          } else {
            $("#jumlahPelanggaran").text("0");
          }

          let karyawanUrl = site_url + "Dashboard_api/countKaryawan";
          return fetchData(karyawanUrl);
        })
        .then((data) => {
          if ($.isEmptyObject(data.totalKaryawan)) {
            $("#jumlahKaryawan").text(data.totalKaryawan);
          } else {
            $("#jumlahKaryawan").text("0");
          }
          allChart(parameterPerbandingan, true);
          $("#filterDashboard").modal("hide");
        })
        .catch((error) => {
          console.error("Error fetching data:", error);
        });
      formFilter = checkForm;
    }
  });
});
