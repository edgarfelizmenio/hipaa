%Uses and disclosures for the facilty directory

permitted_by_164_510_a(A) :-
permitted_by_164_510_a_1(A),
(permitted_by_164_510_a_2(A) ; excluded_164_510_a_3(A)).

permitted_by_164_502_a_1(A):- 
(is_for_directory_purp(A), is_nam_loc_or_condition(A),
%need to implement "asked by name"
 fail); 
(is_to_clergy(A),(is_type_relig(A);is_nam_loc_or_condition(A))).

permitted_by_160_510_a_2(A):- is_about_was_given_consent_opp(A).

excluded_by_164_510_a_3(A):- 
(is_about_incapac(A);is_about_emerg(A)),
fail,
% not sure how to implement is consistent with past, 
 is_belief_best_interest(A).