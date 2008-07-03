%Uses and disclosures for involvement in the individual's care and notification purposes 

permitted_by_164_510_b(A) :-
(permitted_by_164_510_b_1(A),
 permitted_by_164_510_b_2(A),
 permitted_by_164_510_b_3(A));
permitted_by_164_510_b_4(A).

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

%not sure how to implement these yet:
%is_about_present,is_about_avail_for_consent,is_about_in_capac_to_make_dec
%currently they fail

permitted_by_164_510_b_2(A):-
(is_about_present(A);is_about_avail_for_consent(A)),
(is_about_in_capac_to_make_dec(A)),
(is_consentedby_about(A);
 is_about_was_given_consent_opp(A);
 is_belief_best_interest(A)).

permitted_by_164_510_b_3(A):- 
(is_about_present(A));
(not(is_about_incapac(A)),not(is_about_emerg(A)));
(is_belief_best_interest(A), 
(is_relevant_to_payment_or_care_involvement(A);
is_msg_type(A,prescription))).

permitted_by_164_510_b_4(A): 
permitted_by_164_510_b_1_ii(A), 
(is_to_privateEntity(A);is_to_publicEntity(A)), 
(is_to_authorizedByLaw_to_assist_disasterRelief(A);is_to_authorizedByCharter_to_assist_disasterRelief(A)),
((permitted_by_164_510_b_2(A),permitted_by_164_510_b_3(A));is_belief_not_disclosing_would_interfere_with_emergResponse(A)).

