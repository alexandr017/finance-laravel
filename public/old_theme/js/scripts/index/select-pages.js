let indexLinks = [
    [
        ['На карту', '/zaimy/na-kartu'],
        ['Без отказа', '/zaimy/bez-otkaza'],
        ['Без карты', '/zaimy/bez-karty'],
        ['Без процентов', '/zaimy/bez-protsentov'],
        ['Быстрый займ', '/zaimy/bystryj'],
        ['Займы со 100% одобрением', '/zaimy/100-protsentnoe-odobrenie'],
        ['Круглосуточно', '/zaimy/kruglosutochno'],
        ['На Киви кошелек', '/zaimy/na-kivi-koshelek'],
        ['Без кредитной истории', '/zaimy/bez-kreditnoj-istorii'],
        ['Без фото', '/zaimy/dlya-yurlitsa'],
        ['На месяц', '/zaimy/na-mesyats']
    ],
    [
        ["Автокредиты", "/avtokredity"],
        ["Рефинансирование кредитов", "/kredity/refinansirovanie"],
        ["Потребительские", "/kredity/potrebitelskij"],
        ["На карту", "/kredity/na-kartu"],
        ["Наличными", "/kredity/nalichnymi"],
        ["Под залог", "/kredity/pod-zalog"],
        ["Физическим лицам", "/kredity/fizicheskim-litsam"],
        ["С плохой кредитной историей", "/kredity/s-plohoj-kreditnoj-istoriej"],
        ["Пенсионерам", "/kredity/pensioneram"],
        ["Выгодные", "/kredity/vygodnyj"],
        ["Без первоначального взноса", "/kredity/bez-pervonachalnogo-vznosa"],
        ["Без кредитной истории", "/kredity/bez-kreditnoj-istorii"]
    ],
    [
        ["Без отказа", "/kreditnye-karty/bez-otkaza"],
        ["С плохой кредитной историей", "/kreditnye-karty/s-plohoj-kreditnoj-istoriej"],
        ["Без проверок", "/kreditnye-karty/bez-proverok"],
        ["Кредитные карты для пенсионеров", "/kreditnye-karty/pensioneram"],
        ["Кредитные карты с просрочками", "/kreditnye-karty/s-prosrochkami"],
        ["Кредитные карты 120 дней", "/kreditnye-karty/120-dnej"],
        ["Кредитные карты 200 дней", "/kreditnye-karty/200-dnej"],
        ["Лучшие кредитные карты", "/kreditnye-karty/luchshie"],
        ["Виртуальные кредитные карты", "/kreditnye-karty/virtualnye"],
        ["Моментальные кредитные карты", "/kreditnye-karty/momentalnye"]
    ],
    [
        ["Для физических лиц", "/vklady/fizicheskim-litsam"],
        ["С высоким процентом", "/vklady/s-vysokim-protsentom"],
        ["Лучшие", "/vklady/luchshie"],
        ["Выгодные", "/vklady/vygodnye"],
        ["Для пенсионеров", "/vklady/dlya-pensionerov"],
        ["Срочные", "/vklady/srochnye"],
        ["Для юридических лиц", "/vklady/dlya-yuridicheskih-lits"],
        ["Вклады в юанях", "/vklady/v-yuanyah"],
        ["Вклады на 1 месяц", "/vklady/na-1-mesyats"],
        ["Вклады на 2 месяца", "/vklady/na-2-mesyatsa"]
    ],
    [
        ["Льготная ипотека", "/ipoteka/lgotnaya"],
        ["Ипотека с господдержкой", "/ipoteka/s-gospodderzhkoj"],
        ["Ипотека онлайн", "/ipoteka/onlajn"],
        ["Ипотека на вторичное жилье", "/ipoteka/na-vtorichnoe-zhile"],
        ["Ипотека на строительство", "/ipoteka/na-stroitelstvo"],
        ["Военная ипотека", "/ipoteka/voennaya"],
        ["Ипотека без первоначального взноса", "/ipoteka/bez-pervonachalnogo-vznosa"],
        ["Ипотека для молодых семей", "/ipoteka/dlya-molodyh-semej"],
        ["Ипотека с материнским капиталом", "/ipoteka/s-materinskim-kapitalom"],
        ["Рефинансирование ипотеки", "/ipoteka/refinansirovanie"],
        ["Ипотека на новостройки", "/ipoteka/na-novostrojki"]
    ],
    [
        ["Для ИП", "/rko/ip"],
        ["Для ООО", "/rko/ooo"],
        ["Онлайн", "/rko/onlajn"],
        ["Бесплатно", "/rko/besplatnyj"],
        ["За один день", "/rko/za-den"],
        ["По доверенности", "/rko/po-doverennosti"]
    ]
];

let linkToRedirect = '/zaimy/na-kartu';

document.querySelectorAll('#indexFirstSelect .hidden-elements span').forEach((el) => {
    el.addEventListener('click', () => {
        let index = el.getAttribute('data-val');
        renderSecondSelect(index);
        document.querySelectorAll('.active-element2')[0].textContent = indexLinks[index][0][0];
        linkToRedirect = indexLinks[index][0][1];
    });
});

function renderSecondSelect(id)
{
    let foundedArray = indexLinks[id];

    if (foundedArray === undefined) {
        return;
    }

    let code = '';

    for(let i=0; i < foundedArray.length; i++) {
        code += `<span className="line" data-val="${foundedArray[i][1]}">${foundedArray[i][0]}</span>`;
    }

    document.querySelectorAll('#indexSecondSelect .hidden-elements')[0].innerHTML = code;

    document.querySelectorAll('#indexSecondSelect .hidden-elements span').forEach((el) => {
        el.addEventListener('click', () => {
            linkToRedirect = el.getAttribute('data-val');
            console.log(linkToRedirect);
        })
    });

}

renderSecondSelect(0);

document.getElementById('goToPage').addEventListener('click', () => {
    location.href = linkToRedirect;
});