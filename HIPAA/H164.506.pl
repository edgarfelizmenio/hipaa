
:- ['H164.508.pl'].

%% Uses and disclosures to carry out treatment, payment or health care operations.
permitted_by_164_506(A) :-
  permitted_by_164_506_a(A);
  permitted_by_164_506_b(A);
  permitted_by_164_506_c(A).

permitted_by_164_506_a(A) :-
%Standard permitted uses and disclosures
  \+ require_authorization_by_164_508(A),
  is_from_coveredEntity(A),
  is_for_eitherPurpose(A),
  permitted_by_164_506_c(A),
  writeln('HIPAA rule 164_506_a;').
  
permitted_by_164_506_b(A) :-
% This consent is only sufficient if authorization is not 
% required or there is no other condition before the diclosure 
% that needs to be met. 
  is_for_eitherPurpose(A),
  is_consentedby_about(A).  

permitted_by_164_506_c(A) :-
%Implementation Specification
  permitted_by_164_506_c_1(A);
  permitted_by_164_506_c_2(A);
  permitted_by_164_506_c_3(A);
  permitted_by_164_506_c_4(A);
  permitted_by_164_506_c_5(A).

permitted_by_164_506_c_1(A) :-
  is_for_eitherPurpose(A),
  is_phi(A),
  is_msg_to_within(A).

permitted_by_164_506_c_2(A) :-
  is_for_treatment(A),
  is_phi(A),
  is_to_healthCareProvider(A).

permitted_by_164_506_c_3(A) :-
  is_for_payment(A),
  is_phi(A),
  (is_to_healthCareProvider(A);
  is_to_coveredEntity(A)).

permitted_by_164_506_c_4(A) :-
  %writeln('HIPAA rule 164.506.c.4: How to ensure that its a diff covered entitiy? information pertains to that relation'),
  is_from_coveredEntity(A),
  is_to_coveredEntity(A), 
  is_for_healthCareOperations(A),
  %pertains_to(A),
  is_belief_from_about_pertainingToRelationship(A),
  is_msg_about_to_inRelation(A).
  %satisfy_164_506_c_4(A).

satisfy_164_506_c_4(A) :-
  %%Pupose has to be helath care operations along with the ones below.
  %%Currently not working as you need a list of purposes. Right now its just one purpose.
  permitted_by_164_506_c_4_i(A);
  permitted_by_164_506_c_4_ii(A).

permitted_by_164_506_c_4_i(A) :-
  debug('164.506.c.4.i: Could not figure out this para;'),
  is_for_definitionOfHealthCareOperations(A).

permitted_by_164_506_c_4_ii(A) :-
  is_for_healthCareFraudAbuseDetection(A);
  is_for_compliance(A).
  
% Create organizations for each organization and have global rules that
% link each member to the organization. Then just confirm that from and to
% are part of same organization and the purpose is the organization's
%purpose
permitted_by_164_506_c_5(A) :-
  debug('164.506_c_5: Not Implemented yet;').

