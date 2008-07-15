%Uses and disclosures for involvement in the individual's care and notification purposes 

permitted_by_164_510_b(A) :-
(permitted_by_164_510_b_1(A)).

permitted_by_164_510_b_1(A) :-
permitted_by_164_510_b_1_i(A);
permitted_by_164_510_b_1_ii(A).

permitted_by_164_510_b_1_i(A):- 
is_phi(A), 
is_from_coveredEntity(A), 
(is_to_relative(A);is_to_closeFriend(A);is_to_personIdentified(A)), 
is_relevant_to_payment_or_care_involvement(A).


permitted_by_164_510_b_1_ii(A):- 
is_phi(A),
is_from_coveredEntity(A), 
(is_for_notification_fam_personalrep_respons_of_location(A);
is_for_notification_fam_personalrep_respons_of_gencond(A);
is_for_notification_fam_personalrep_respons_of_death(A)).

