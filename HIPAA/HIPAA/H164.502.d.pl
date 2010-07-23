
%%Uses and disclosure of deindentified information

permitted_by_164_502_d(A) :-
  permitted_by_164_502_d_1(A);
  permitted_by_164_502_d_2(A).

permitted_by_164_502_d_1(A) :-
%use part is not so clear, just modelled the disclosure part.
  is_phi(A),
  is_from_coveredEntity(A),
  is_to_businessAssociateOf(A),
  is_for_createDeidentifiedInfo(A),
  writeln('HIPAA rule 164_502_d_1;').

permitted_by_164_502_d_2(A) :-
  permitted_by_164_514(A),
  (excluded_by_164_502_d_2_i(A);
  permitted_by_164_502_d_2_ii(A)),
  writeln('HIPAA rule 164_502_b_2;').

excluded_by_164_502_d_2_i(A) :-
%verify that the message does not have identifiable attributes for join like primary keys
  fail.

permitted_by_164_502_d_2_ii(A) :-
% verify that the de-indentified information is not re-identified 
  fail.

forbidden_by_164_502_d(A) :-
 fail.
