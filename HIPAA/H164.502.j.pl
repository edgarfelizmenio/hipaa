
%%Disclosure by whistleblowers and work force members crime victims

permitted_by_164_502_j(A) :-
  permitted_by_164_502_j_1(A);
  permitted_by_164_502_j_2(A).

permitted_by_164_502_j_1(A) :-
   (is_from_employeeOf(A, Y);
    is_from_businessAssociateOf(A, Y)),
   permitted_by_164_502_j_1_i(A, Y),
   permitted_by_164_502_j_1_ii(A, Y).

permitted_by_164_502_j_1_i(A, Y) :-
%basically this belief includes "they believe in good faith that the covered Entity has engaged in conduct
% that is unlawful or otherwise violates professional or clinical standards, or that the care, 
% services or conditions provided by covered entity potentially endangers one or more patients, 
% workers or the public"
  is_belief_from_unlawfulCoveredEntity(A, Y),
  writeln('HIPAA rule 164_502_j_1_i;').

permitted_by_164_502_j_1_ii(A, Y) :-
  permitted_by_164_502_j_1_ii_A(A, Y);
  permitted_by_164_502_j_1_ii_B(A, Y).

permitted_by_164_502_j_1_ii_A(A, Y) :-
  is_to_healthOversightAgency(A);

  (is_to_publicHealthAuthority(A),
  is_for_investigation(A));

  (is_to_healthCareAccreditationOrganization(A),
  is_for_standardsFailureMisconduct(A, Y)),

  writeln('HIPAA rule 164_502_j_1_ii_A;').

permitted_by_164_502_j_1_ii_B(A, Y) :-
  is_to_legalAttorney(A),
  is_for_determiningLegalOptions(A),
  %is_belief_from_unlawfulCoveredEntity(A, Y),
  writeln('HIPAA rule 164_502_j_1_ii_B;').

permitted_by_164_502_j_2(A) :-
  is_from_employeeOf(A, Y),
  is_belief_from_employeeVictimOfCriminalAct(A, Y),
  is_to_lawEnforcementOfficer(A),
  is_phi(A),
  permitted_by_164_502_j_2_i(A),
  permitted_by_164_502_j_2_ii(A),
  writeln('HIPAA rule 164_502_j_2;').
  
permitted_by_164_502_j_2_i(A) :-
  is_about_suspectedCrimePerpetrator(A).

permitted_by_164_502_j_2_ii(A) :-
  permitted_by_164_512_f_2_i(A).

