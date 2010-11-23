
:- ['./HIPAA/H164.522.pl'].

%%Confidential communication

permitted_by_164_502_h(A) :-
  (is_from_healthCareProvider(A);
  is_from_healthPlan(A)),
  is_phi(A),
  permitted_by_164_522_b(A),
  writeln('HIPAA rule 164_502_h;').


forbidden_by_164_502_h(A) :-
  fail.

