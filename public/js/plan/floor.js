function onWindowResize() {
    window.setTimeout(function () {
        const e = $('.floor-plan-holder').width();
        $(".floorplan").mapster("resize",e);
    }, 200);
}

$(document).ready(function() {
    const sold = 'ec2327'; // mieszkanie sprzedane
    const reservation = '1788c9'; // mieszkanie zarezerwowane
    const forsale = '3a9019'; // mieszkanie na sprzedaz
    const rent = 'de8300'; // mieszkanie wynajete
    const hoverOpacity = 0.8;
    const normalState = 0;

    const tabEl = document.querySelectorAll('button[data-bs-toggle="tab"]');
    tabEl.forEach(function(el){
        el.addEventListener('shown.bs.tab', function (event) {
            const e = $('.floor-plan-holder').width();
            $(".floorplan").mapster("resize",e);
        })
    })

    $(".floorplan").mapster({
        onClick: function() {
            const a = $(this).attr("data-roomstatus");
            // if (a !== "2") {
            //     window.open(this.href, "_self")
            // } else {
            //     return false
            // }

            window.open(this.href, "_self")
        },
        fillOpacity: hoverOpacity,
        onMouseover: function() {
            const a = $(this).attr("data-roomstatus");
            if (a === "2") {
                $(this).mapster("set", false).mapster("set", true, {
                    fillColor: reservation,
                    fillOpacity: hoverOpacity
                })
            }
            if (a === "3") {
                $(this).mapster("set", false).mapster("set", true, {
                    fillColor: sold,
                    fillOpacity: hoverOpacity
                })
            }
            if (a === "1") {
                $(this).mapster("set", false).mapster("set", true, {
                    fillColor: forsale,
                    fillOpacity: hoverOpacity
                })
            }
            if (a === "4") {
                $(this).mapster("set", false).mapster("set", true, {
                    fillColor: rent,
                    fillOpacity: hoverOpacity
                })
            }
        },
        onMouseout: function() {
            $(this).mapster("set", false);
            $("area[data-roomstatus='2']").mapster("set", true, {
                fillColor: reservation,
                fillOpacity: normalState
            });
            $("area[data-roomstatus='3']").mapster("set", true, {
                fillColor: sold,
                fillOpacity: normalState
            });
            $("area[data-roomstatus='1']").mapster("set", true, {
                fillColor: forsale,
                fillOpacity: normalState
            });
            $("area[data-roomstatus='4']").mapster("set", true, {
                fillColor: rent,
                fillOpacity: normalState
            })
        }
    });

    $("area[data-roomstatus='2']").mapster("set", true, {
        fillColor: reservation,
        fillOpacity: normalState
    });
    $("area[data-roomstatus='3']").mapster("set", true, {
        fillColor: sold,
        fillOpacity: normalState
    });
    $("area[data-roomstatus='1']").mapster("set", true, {
        fillColor: forsale,
        fillOpacity: normalState
    });
    $("area[data-roomstatus='4']").mapster("set", true, {
        fillColor: rent,
        fillOpacity: normalState
    });
});

$(window).bind('resize', onWindowResize);
