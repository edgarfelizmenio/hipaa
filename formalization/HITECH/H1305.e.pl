permitted_by_13405_e(A) :-
  msg_from(A, X),
  msg_about(A, Y),
  X = Y,
  writeln('HITECH rule 13405.e;').
