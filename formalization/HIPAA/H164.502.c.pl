
:- ['./HIPAA/H164.522.pl'].
%%Uses and Disclosure of protected health information subject to agreed upon restriction

permitted_by_164_502_c(A) :-
% must also check whether restriction exists for a particular case 
  is_from_coveredEntity(A),
  is_phi(A),
  (permitted_by_164_522_a_1(A);
   permitted_by_164_522_a(A)),
  writeln('HIPAA rule 164_502_c;').

forbidden_by_164_502_c(A) :-
  fail.
