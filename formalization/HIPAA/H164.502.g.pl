
%%Uses and disclosure to personal representatives

permitted_by_164_502_g(A) :-
  permitted_by_164_502_g_1(A);
  permitted_by_164_502_g_2(A);
  permitted_by_164_502_g_3(A);
  permitted_by_164_502_g_4(A);
  permitted_by_164_502_g_5(A).

permitted_by_164_502_g_1(A) :-
%treat personal representative as individual except by g-3 ang g-5.
  fail,
  writeln('HIPAA rule 164_502_g_1;').

permitted_by_164_502_g_2(A) :-
% should treat adult or emancipated minor in making decision as individual, 
% relavant to such personal representatives.
  is_about_adult(A),
  msg_about(A, X),
  personal_representative(X, Y),
  (msg_to(A, Y);
  msg_from(A, Y)),
  writeln('HIPAA rule 164_502_g_2;').

is_guardian(X, Y) :-
  parent(X, Y);
  guardian(X, Y);
  loco_parentis(X, Y).

permitted_by_164_502_g_3(A) :-
%Assuming there are no applicable provisions or other applicable state laws,
%should be allowed if 3i and 164.524 allow it, and denied if they deny.
% else (when neither are applicable) the decision is made by licensed health professional

  permitted_by_164_502_g_3_i(A);
  permitted_by_164_502_g_3_ii(A).



permitted_by_164_502_g_3_i(A) :-
% relavant to such personal representatives.
% about health care services
  is_about_minor(A),
  msg_about(A, X),
  (msg_to(A, Y);
  msg_from(A,Y)),
  is_guardian(X, Y),
  \+ (permitted_by_164_502_g_3_i_A(A),
      permitted_by_164_502_g_3_i_B(A),
      permitted_by_164_502_g_3_i_C(A)),
  writeln('HIPAA rule 164_502_g_3_i;').
%rule requires you to remove a parents role
% as a personal representative globally in the shh file. 
% this can be done if the child requests such or parent agrees 

permitted_by_164_502_g_3_i_A(A) :-
  fail.
  
permitted_by_164_502_g_3_i_B(A) :-
  fail.

permitted_by_164_502_g_3_i_C(A) :-
  fail.

permitted_by_164_502_g_3_ii(A) :-
  permitted_by_164_502_g_3_ii_A(A);
  permitted_by_164_502_g_3_ii_B(A);
  permitted_by_164_502_g_3_ii_C(A).

permitted_by_164_502_g_3_ii_A(A) :-
% covered entity may send to guardian based on applicable law
  fail,
  writeln('HIPAA rule 164_502_g_3_ii_A;').
%add if permitted by any othe sepcified by laws

permitted_by_164_502_g_3_ii_B(A) :-
% covered entity may NOT send to guardian based on applicable law
  fail,
  writeln('HIPAA rule 164_502_g_3_ii_B;').

permitted_by_164_502_g_3_ii_C(A) :-
% will add one more rule representing personal representative in add. to guardian
%if personal rep ties are broken, then
% licensed medical practioner may send based on professional judgement
  fail,
  writeln('HIPAA rule 164_502_g_3_ii_C;').

permitted_by_164_502_g_4(A) :-
  is_about_deceasedIndividual(A),
  msg_about(A, X),
  personal_representative(X, Y),
  (msg_to(A, Y);
  msg_from(A, Y)),
  writeln('HIPAA rule 164_502_g_4;').
  
permitted_by_164_502_g_5(A) :-
  permitted_by_164_502_g_5_i(A);
  permitted_by_164_502_g_5_ii(A).

permitted_by_164_502_g_5_i(A) :-
  msg_about(A, X),
  msg_to(A, Y),
  %is_belief_dangerousRepresentative(X, Y).
  fail,
  writeln('HIPAA rule 164_502_g_5_i;').

permitted_by_164_502_g_5_ii(A) :-
  %is_belief_notBestInterestOfIndividual(X, Y).
  fail,
  writeln('HIPAA rule 164_502_g_5_ii;').

forbidden_by_164_502_g(A) :-
  fail.
