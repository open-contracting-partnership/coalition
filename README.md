# 1. Dodawanie nowego wpisu

hugo new posts/tytul_nowego_wpisu.md

## Dodawanie nowego logo

hugo new logotypes/tytul_nowego_logo.md

## Redagowanie wpisu

Nalezy przejsc do katalogu posts i wyedytowac plik tytul_nowego_wpisu.md - nalezy odpowiednio uzupelnic pola

```
---
title: "Tytul_nowego_wpisu"
date: 2021-11-22T23:16:43+01:00
draft: true
alternativeUrl: 
summary: 
thumbnail: "i/europe.svg"
---
```

Pole alternativeUrl uzywane jest jezeli chcemy zeby zamiast do podstrony z trescia linki odnosily nas do zewnetrznej strony

Pole thumbnail uzywane jest do dodania obrazka miniaturki do wpisu - trzeba go wczesniej dodac do katalogu static a sciezka wpisywana w tym polu zaczyna sie wewnatrz katalogu static np. dla static/i/europe.svg wpisujemy jedynie i/europe.svg

Pole summary mozna uzywac skladni markdown np. zeby zrobic link

## Redagowanie logotypu

Nalezy przejsc do katalogu logotypes i wyedytowac plik tytul_nowego_logo.md - nalezy odpowiednio uzupelnic pola

```
---
title: ""
draft: true
link: ""
image: "i/europe.svg"
---

```


Pole image uzywane jest do dodania obrazka z logo organizacji - trzeba go wczesniej dodac do katalogu static a sciezka wpisywana w tym polu zaczyna sie wewnatrz katalogu static np. dla static/i/europe.svg wpisujemy jedynie i/europe.svg

Pole link to link do strony organizacji powiązanej z dodanym logo

### WAZNE

Po skonczonej edycji trzeba zmienic draft na false - tak publikuje sie nowy wpis

## Poradnik uzywania [markdown](https://www.markdownguide.org/getting-started/)

# 2. Commitowanie zmian

Nalezy wykonac nastepujace operacje:

`git add .`

`git commit -a -m 'Informacja o dodaniu nowego wpisu'`

`git push`

### Strona po około minucie od wykonania powyzszej kombinacji polecen odswiezy sie samodzielnie na serwerze

# 3. Podgląd lokalny

Podczas edytowania strony na kompyterze mozna podejrzeć efekt pracy wpisując w terminalu:
`hugo server -D`

W efekcie uruchomiony zostanie serwer testowy pod adresem:

`http://localhost:1313/`

