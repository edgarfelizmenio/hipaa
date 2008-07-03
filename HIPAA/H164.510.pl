%% Uses and disclosures requiring an opportunity for the individual to agree or to object

permitted_by_164_510(A) :-
  is_about_was_given_consent_opp(A),
  is_phi(A),
  (permitted_by_164_510_a(A); 
   permitted_by_164_510_b(A)).
