var token = '0c32ba1f36b0cab5f28582a141bcdb43868ea0a8';
$("#email").suggestions({token: token,type: "EMAIL",params: {parts: ["EMAIL"]}});

// Инициализирует подсказки по ФИО на указанном элементе
function init($surname, $name, $patronymic) {
  var self = {};
  self.$surname = $surname;
  self.$name = $name;
  self.$patronymic = $patronymic;
  var fioParts = ["SURNAME", "NAME", "PATRONYMIC"];
  $.each([$surname, $name, $patronymic], function(index, $el) {
    var sgt = $el.suggestions({
      token: token,
      type: "NAME",
      triggerSelectOnSpace: false,
      hint: "",
      noCache: true,
      params: {
        // каждому полю --- соответствующая подсказка
        parts: [fioParts[index]]
      },
      onSearchStart: function(params) {
        // если пол известен на основании других полей,
        // используем его
        var $el = $(this);
        params.gender = isGenderKnown.call(self, $el) ? self.gender : "UNKNOWN";
      },
      onSelect: function(suggestion) {
        // определяем пол по выбранной подсказке
        self.gender = suggestion.data.gender;
      }
    });
  });
};

// Проверяет, известен ли пол на данный момент
function isGenderKnown($el) {
  var self = this;
  var surname = self.$surname.val(),
      name = self.$name.val(),
      patronymic = self.$patronymic.val();
  if (($el.attr('id') == self.$surname.attr('id') && !name && !patronymic) ||
      ($el.attr('id') == self.$name.attr('id') && !surname && !patronymic) ||
      ($el.attr('id') == self.$patronymic.attr('id') && !surname && !name)) {
    return false;
  } else {
    return true;
  }
}

init($("#second_name"), $("#first_name"), $("#middle_name"));
