:- ['./HIPAA/H164.510.a.pl'].
:- ['./HIPAA/H164.510.b.pl'].


%% Uses and disclosures requiring an opportunity for the individual to agree or to object

permitted_by_164_510(A):-
  is_phi(A),
  (permitted_by_164_510_a(A); permitted_by_164_510_b(A)).

forbidden_by_164_510(A):-
  fail.
