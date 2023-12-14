! function() {
    angular.module("riskMatrix", []).directive("riskMatrix", ["$compile", function(i) {
        return {
            restrict: "E",
            scope: {
                items: "=data",
                impact: "=impact",
                probability: "=probability",
                template: "=?template"
            },
            link: function(t, e, a) {
                var s = function(a) {
                    var s = i(a)(t);
                    e.empty(), e.append(s), s.css("height", s[0].clientWidth + "px");
                    for (var o = 0, d = 0; 36 > d; d++) ! function(i) {
                        var t = i % 6,
                            e = "low";
                        // (1 == o && 3 > t || 2 == o && 4 > t || 18 == i || 24 == i) && (e = "medium"), 
                        // (3 == o && 3 > t || 4 == o && 4 > t || 10 == i) && (e = "high"),
                        (0 == o && 0 == t) && (e = "dahsyat"),
                        (0 == o && 1 == t) && (e = "besar"),
                        (0 == o && 2 == t) && (e = "menengah"),
                        (0 == o && 3 == t) && (e = "rendah"),
                        (0 == o && 4 == t) && (e = "tidak_significant"), 
                        (0 == o && 5 == t) && (e = "keterangan"), 
                        
                        (1 == o && 0 == t) && (e = "high"),
                        (1 == o && 1 == t) && (e = "medium"),
                        (1 == o && 2 == t) && (e = "low"),
                        (1 == o && 3 == t) && (e = "low"),
                        (1 == o && 4 == t) && (e = "low"), 
                        (1 == o && 5 == t) && (e = "sangat_kecil"),
                        
                        (2 == o && 0 == t) && (e = "extreme"),
                        (2 == o && 1 == t) && (e = "high"),
                        (2 == o && 2 == t) && (e = "medium"),
                        (2 == o && 3 == t) && (e = "low"),
                        (2 == o && 4 == t) && (e = "low"),
                        (2 == o && 5 == t) && (e = "kecil"), 
                        
                        (3 == o && 0 == t) && (e = "extreme"),
                        (3 == o && 1 == t) && (e = "high"),
                        (3 == o && 2 == t) && (e = "high"),
                        (3 == o && 3 == t) && (e = "medium"),
                        (3 == o && 4 == t) && (e = "low"), 
                        (3 == o && 5 == t) && (e = "sedang"), 
                        
                        (4 == o && 0 == t) && (e = "extreme"),
                        (4 == o && 1 == t) && (e = "extreme"),
                        (4 == o && 2 == t) && (e = "high"),
                        (4 == o && 3 == t) && (e = "medium"),
                        (4 == o && 4 == t) && (e = "low"), 
                        (4 == o && 5 == t) && (e = "besar2"), 

                        (5 == o && 0 == t) && (e = "extreme"),
                        (5 == o && 1 == t) && (e = "extreme"),
                        (5 == o && 2 == t) && (e = "extreme"),
                        (5 == o && 3 == t) && (e = "high"),
                        (5 == o && 4 == t) && (e = "medium"), 
                        (5 == o && 5 == t) && (e = "hampir_pasti"), 
                        s.append('<div class="risk-box col-' + o + " row-" + t + " " + e + '-risk"></div>'), 5 == t && o++
                    }(d)
                };
                a.template ? t.$watch("template", function() {
                    t.template && s('<div class="risk-matrix"><div class="left-label">DAMPAK</div><div class="bottom-label">KEMUNGKINAN</div><div style="position:absolute;width:100%;height:100%;"><div risk-matrix-item ng-repeat="item in items" class="risk-matrix-item" style="position:absolute;">' + t.template + "</div></div></div>")
                }) : s('<div class="risk-matrix"><div class="left-label">DAMPAK</div><div class="bottom-label">KEMUNGKINAN</div><div style="position:absolute;width:100%;height:100%;"><div risk-matrix-item ng-repeat="item in items" class="risk-matrix-item" style="position:absolute;"><div class="closed"><span ng-bind="item.Id"></span></div><div class="open"><div ng-bind="\'Impact: \'+item.RiskImpact"></div><div ng-bind="\'Probability: \'+item.RiskProbability"></div></div></div></div></div>')
            }
        }
    }]).directive("riskMatrixItem", ["$timeout", function(i) {
        return {
            restrict: "A",
            link: function(t, e) {
                e.css({
                    bottom: 90 * Math.random() + 5 + "%",
                    left: 90 * Math.random() + 5 + "%"
                }), t.$watch("item", function() {
                    i(function() {
                        e.css({
                            bottom: 19 * t.impact.indexOf(t.item.RiskImpact) + shuffle(Math.floor(Math.random() * 15 + 1)) + 5 + "%",
                            left: 19 * t.probability.indexOf(t.item.RiskProbability) + shuffle(Math.floor(Math.random() * 15 + 1)) + 5 + "%"
                        })
                    }, 500)
                }, !0)
            }
        }
    }])
}();

function shuffle(o) {
    for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
};