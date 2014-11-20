# language: pl
Funkcja: addAuthor
  Żeby post mógł posiadać więcej autorów
  Musi być możliwość dodania go do modelu Post


Założenia:
  Mając model Post

Scenariusz: Dodawanie do istniejącego postu
  Zakładając jest model Post
  I ma autora Jan
  Kiedy dodam do postu autora
  Wtedy post powinien mieć dwóch autorów
