$(document).ready(function () {
    $("body").hasClass("comp-wizard") && ($("#demo-wizard").on("change", function (e, t) {
	return $("#form" + t.step).length > 0 && ($("#form" + t.step).parsley("validate"), !$("#form" + t.step).parsley("isValid")) ? !1 : ($btnNext = $(this).parents(".wizard-wrapper").find(".btn-next"), void(3 === t.step && "next" == t.direction ? $btnNext.text(" Create My Account").prepend('<i class="fa fa-check-circle"></i>').removeClass("btn-primary").addClass("btn-success") : $btnNext.text("Next ").append('<i class="fa fa-arrow-right"></i>').removeClass("btn-success").addClass("btn-primary")))
    }).on("finished", function () {
	alert("Your account has been created.")
    }), $(".wizard-wrapper .btn-next").click(function () {
	$("#demo-wizard").wizard("next")
    }), $(".wizard-wrapper .btn-prev").click(function () {
	$("#demo-wizard").wizard("previous")
    }));
    var e = ["#5DC8CD", "#34C6CD", "#01939A", "#1D7074", "#006064"];
    if ($("body").hasClass("demo-maps")) {
	$(".basic-map").mapael({
	    map: {
		name: "world_countries"
	    }
	});
	var t = {
	    areas: {
		US: {
		    value: 2200,
		    tooltip: {
			content: "<span>United States</span><br />Sales: 2200"
		    }
		},
		CN: {
		    value: 1800,
		    tooltip: {
			content: "<span>China</span><br />Sales: 1800"
		    }
		},
		JP: {
		    value: 1550,
		    tooltip: {
			content: "<span>Japan</span><br />Sales: 1550"
		    }
		},
		IN: {
		    value: 1400,
		    tooltip: {
			content: "<span>India</span><br />Sales: 1400"
		    }
		},
		DE: {
		    value: 1600,
		    tooltip: {
			content: "<span>Germany</span><br />Sales: 1600"
		    }
		},
		RU: {
		    value: 900,
		    tooltip: {
			content: "<span>Russia</span><br />Sales: 900"
		    }
		},
		GB: {
		    value: 1200,
		    tooltip: {
			content: "<span>United Kingdom</span><br />Sales: 1200"
		    }
		},
		FR: {
		    value: 1100,
		    tooltip: {
			content: "<span>France</span><br />Sales: 1100"
		    }
		},
		BR: {
		    value: 400,
		    tooltip: {
			content: "<span>Brazil</span><br />Sales: 400"
		    }
		},
		IT: {
		    value: 700,
		    tooltip: {
			content: "<span>Italy</span><br />Sales: 700"
		    }
		},
		MX: {
		    value: 1900,
		    tooltip: {
			content: "<span>Mexico</span><br />Sales: 1900"
		    }
		},
		ES: {
		    value: 300,
		    tooltip: {
			content: "<span>Spain</span><br />Sales: 300"
		    }
		},
		KR: {
		    value: 200,
		    tooltip: {
			content: "<span>South Korea</span><br />Sales: 200"
		    }
		},
		CA: {
		    value: 2900,
		    tooltip: {
			content: "<span>Canada</span><br />Sales: 2900"
		    }
		},
		ID: {
		    value: 1200,
		    tooltip: {
			content: "<span>Indonesia</span><br />Sales: 1300"
		    }
		},
		TR: {
		    value: 90,
		    tooltip: {
			content: "<span>Turkey</span><br />Sales: 90"
		    }
		},
		IR: {
		    value: 80,
		    tooltip: {
			content: "<span>Iran</span><br />Sales: 80"
		    }
		},
		AU: {
		    value: 900,
		    tooltip: {
			content: "<span>Australia</span><br />Sales: 1400"
		    }
		},
		ZA: {
		    value: 50,
		    tooltip: {
			content: "<span>South Africa</span><br />Sales: 50"
		    }
		},
		EG: {
		    value: 20,
		    tooltip: {
			content: "<span>Egypt</span><br />Sales: 20"
		    }
		},
		PK: {
		    value: 1300,
		    tooltip: {
			content: "<span>Pakistan</span><br />Sales: 1300"
		    }
		},
		SG: {
		    value: 100,
		    tooltip: {
			content: "<span>Singapore</span><br />Sales: 100"
		    }
		}
	    }
	};
	$(".data-visualization-map").mapael({
	    map: {
		name: "world_countries",
		defaultArea: {
		    attrs: {
			stroke: "#fff",
			"stroke-width": 1,
			fill: "#c4c4c4"
		    }
		}
	    },
	    legend: {
		area: {
		    display: !0,
		    title: "Sales",
		    slices: [{
			max: 100,
			attrs: {
			    fill: e[0]
			},
			label: "Less than 100"
		    }, {
			min: 100,
			max: 500,
			attrs: {
			    fill: e[1]
			},
			label: "Between 100 and 500"
		    }, {
			min: 500,
			max: 1e3,
			attrs: {
			    fill: e[2]
			},
			label: "Between 500 and 1000"
		    }, {
			min: 1e3,
			max: 1500,
			attrs: {
			    fill: e[3]
			},
			label: "Between 1000 and 1500"
		    }, {
			min: 1500,
			attrs: {
			    fill: e[4]
			},
			label: "More than 1500"
		    }]
		}
	    },
	    areas: t.areas
	}), $mapZoom = $(".zoom-map"), $mapZoom.mapael({
	    map: {
		name: "france_departments",
		zoom: {
		    enabled: !0,
		    maxLevel: 10
		},
		defaultPlot: {
		    attrs: {
			opacity: .6
		    }
		}
	    },
	    areas: {
		"department-56": {
		    text: {
			content: "56"
		    },
		    tooltip: {
			content: "Morbihan (56)"
		    }
		}
	    },
	    plots: {
		paris: {
		    latitude: 48.86,
		    longitude: 2.3444
		},
		lyon: {
		    type: "circle",
		    size: 50,
		    latitude: 45.758888888889,
		    longitude: 4.8413888888889,
		    value: 7e5,
		    href: "http://fr.wikipedia.org/wiki/Lyon",
		    tooltip: {
			content: '<span style="font-weight:bold;">City :</span> Lyon'
		    },
		    text: {
			content: "Lyon"
		    }
		},
		rennes: {
		    type: "square",
		    size: 20,
		    latitude: 48.114166666667,
		    longitude: -1.6808333333333,
		    tooltip: {
			content: '<span style="font-weight:bold;">City :</span> Rennes'
		    },
		    text: {
			content: "Rennes"
		    },
		    href: "http://fr.wikipedia.org/wiki/Rennes"
		}
	    }
	}), $mapZoom.on("mousewheel", function (e) {
	    return e.deltaY > 0 ? $mapZoom.trigger("zoom", $mapZoom.data("zoomLevel") + 1) : $mapZoom.trigger("zoom", $mapZoom.data("zoomLevel") - 1), !1
	}), $("#focus-paris").on("click", function () {
	    var e = $.fn.mapael.maps.france_departments.getCoords(48.114167, 2.3444);
	    $mapZoom.trigger("zoom", [10, e.x, e.y])
	}), $("#focus-lyon").on("click", function () {
	    var e = $.fn.mapael.maps.france_departments.getCoords(45.758888888889, 4.8413888888889);
	    $mapZoom.trigger("zoom", [5, e.x, e.y])
	}), $("#map-clear-zoom").on("click", function () {
	    $mapZoom.trigger("zoom", [0])
	})
    }
    if ($(".data-us-map").length > 0 && $(".data-us-map").mapael({
	map: {
	    name: "usa_states",
	    defaultPlot: {
		size: 10
	    },
	    defaultArea: {
		attrs: {
		    stroke: "#fafafa",
		    "stroke-width": 1,
		    fill: "#c4c4c4"
		}
	    }
	},
	legend: {
	    plot: {
		display: !0,
		title: "US Sales Map",
		hideElemsOnClick: {
		    opacity: 0
		},
		slices: [{
		    size: 10,
		    type: "circle",
		    max: 500,
		    attrs: {
			fill: e[1]
		    },
		    label: "Less than 500 sales"
		}, {
		    size: 20,
		    type: "circle",
		    min: 500,
		    max: 750,
		    attrs: {
			fill: e[1]
		    },
		    label: "Between 500 and 750 sales"
		}, {
		    size: 30,
		    type: "circle",
		    min: 750,
		    max: 1e3,
		    attrs: {
			fill: e[1]
		    },
		    label: "Between 750 and 1000 sales"
		}, {
		    size: 40,
		    type: "circle",
		    min: 1e3,
		    max: 1250,
		    attrs: {
			fill: e[1]
		    },
		    label: "Between 1000 and 1250 sales"
		}, {
		    size: 50,
		    type: "circle",
		    min: 1250,
		    max: 1500,
		    attrs: {
			fill: e[1]
		    },
		    label: "Between 1250 and 1500 sales"
		}]
	    }
	},
	plots: {
	    ny: {
		value: 1450,
		latitude: 40.717079,
		longitude: -74.00116,
		tooltip: {
		    content: "<span>New York</span><br />Sales: 1450"
		}
	    },
	    an: {
		value: 900,
		latitude: 61.2108398,
		longitude: -149.9019557,
		tooltip: {
		    content: "<span>Anchorage</span><br />Sales: 900"
		}
	    },
	    sf: {
		value: 1200,
		latitude: 37.792032,
		longitude: -122.394613,
		tooltip: {
		    content: "<span>San Francisco</span><br />Sales: 1200"
		}
	    },
	    pa: {
		value: 400,
		latitude: 19.493204,
		longitude: -154.8199569,
		tooltip: {
		    content: "<span>Pahoa</span><br />Sales: 400"
		}
	    },
	    nm: {
		value: 850,
		latitude: 35.101934,
		longitude: -106.633301,
		tooltip: {
		    content: "<span>Albuquerque</span><br />Sales: 850"
		}
	    },
	    nj: {
		value: 30,
		latitude: 38.934385,
		longitude: -74.908028,
		tooltip: {
		    content: "<span>Cape May</span><br />Sales: 30"
		}
	    },
	    il: {
		value: 1100,
		latitude: 41.879786,
		longitude: -87.62352,
		tooltip: {
		    content: "<span>Chicago</span><br />Sales: 1100"
		}
	    },
	    or: {
		value: 70,
		latitude: 19.493204,
		longitude: -154.8199569,
		tooltip: {
		    content: "<span>Portland</span><br />Sales: 70"
		}
	    }
	}
    }), $("body").hasClass("fullcalendar")) {
	$("#external-events div.external-event").each(function () {
	    var e = {
		title: $.trim($(this).text())
	    };
	    $(this).data("eventObject", e), $(this).draggable({
		zIndex: 999,
		revert: !0,
		revertDuration: 0
	    })
	});
	var a = new Date,
	    n = a.getDate(),
	    l = a.getMonth(),
	    o = a.getFullYear();
	$(".calendar").fullCalendar({
	    header: {
		left: "month, agendaWeek, agendaDay",
		center: "title",
		right: "prev, next, today"
	    },
	    editable: !0,
	    droppable: !0,
	    drop: function (e, t) {
		var a = $(this).data("eventObject"),
		    n = $.extend({}, a);
		n.start = e, n.allDay = t, $(".calendar").fullCalendar("renderEvent", n, !0), $("#drop-remove").is(":checked") && $(this).remove()
	    },
	    events: [{
		title: "All Day Event",
		start: new Date(o, l, 1)
	    }, {
		title: "Long Event",
		start: new Date(o, l, n + 5),
		end: new Date(o, l, n + 7)
	    }, {
		id: 999,
		title: "Repeating Event",
		start: new Date(o, l, n - 3, 16, 0),
		allDay: !1
	    }, {
		id: 999,
		title: "Repeating Event",
		start: new Date(o, l, n + 4, 16, 0),
		allDay: !1
	    }, {
		title: "Meeting",
		start: new Date(o, l, n, 10, 30),
		allDay: !1
	    }, {
		title: "Lunch",
		start: new Date(o, l, n, 12, 0),
		end: new Date(o, l, n, 14, 0),
		allDay: !1
	    }, {
		title: "Birthday Party",
		start: new Date(o, l, n + 1, 19, 0),
		end: new Date(o, l, n + 1, 22, 30),
		allDay: !1
	    }, {
		title: "Visit Other Theme",
		start: new Date(o, l, 28),
		end: new Date(o, l, 29),
		url: "https://wrapbootstrap.com/theme/cvilized-timeline-style-cv-resume-WB057FN0R"
	    }]
	}), $colorPicker = $('select[name="colorpicker-picker-longlist"]'), $colorPicker.simplecolorpicker({
	    picker: !1,
	    theme: "fontawesome"
	}), $("#btn-quick-event").click(function () {
	    var e = $(this).data("eventObject"),
		t = $.extend({}, e),
		n = "Untitled Event";
	    "" != $("#quick-event-name").val() && (n = $("#quick-event-name").val()), t.title = n, t.start = a, t.color = $colorPicker.val(), $(".calendar").fullCalendar("renderEvent", t, !0)
	})
    }
});