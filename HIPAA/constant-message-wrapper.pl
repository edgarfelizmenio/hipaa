:- ['basic-message-structure.pl'].
%% this file provides wrappers to call the basic routines.
%% all rules start with 'is'

%%%%%%%%%%% FROM
is_from_coveredEntity(A) :-
  is_msg_from_role(A, covered_entity).

is_from_employeeOf(A, Y) :-
  msg_from(A, X),
  employee_of(X, Y).

is_from_businessAssociateOf(A) :-
  msg_from(A, X),
  msg_to(A, M),
  business_associate(X, M).

is_from_businessAssociateOf(A, Y) :-
  msg_from(A, X),
  business_associate(X, Y).

is_from_healthCareProvider(A) :-
  is_msg_from_role(A, healthCare_provider).
  %is_from_employeeOf(A, Y),
  %in_role(Y, healthCare_provider).

is_from_healthPlan(A) :-
  is_msg_from_role(A, health_plan).
  %is_from_employeeOf(A, Y),
  %in_role(Y, health_plan).

is_from_healthInsuranceIssuer(A) :-
  is_msg_from_role(A, health_insurance_issuer).
  %is_from_employeeOf(A, Y),
  %in_role(Y, health_insurance_issuer).

is_from_groupHealthPlan(A) :-
  is_msg_from_role(A, group_health_plan).
  %is_from_employeeOf(A, Y),
  %in_role(Y, group_health_plan).

is_from_governmentAgencyHealthPlan(A) :-
  is_msg_from_role(A, government_agency_health_plan).
  %is_from_employeeOf(A, Y),
  %in_role(Y, government_agency_health_plan).

%%%%%%%%%%% To
is_to_coveredEntity(A) :-
  is_msg_to_role(A, covered_entity).

is_to_employeeOf(A, Y) :-
  msg_to(A, X),
  employee_of(X, Y).

is_to_businessAssociateOf(A) :-
  msg_to(A, X),
  msg_from(A, M),
  business_associate(X, M).

is_to_businessAssociateOf(A, Y) :-
  msg_to(A, X),
  business_associate(X, Y).
  
is_to_healthOversightAgency(A) :-
  is_msg_to_role(A, health_oversight_agency).
  %is_to_employeeOf(A, Y),
  %in_role(Y, health_oversight_agency).

is_to_publicHealthAuthority(A) :-
  is_msg_to_role(A, public_health_authority).
  %is_to_employeeOf(A, Y),
  %in_role(Y, public_health_authority).

is_to_healthCareAccreditationOrganization(A) :-
  is_msg_to_role(A, healthCare_accreditation_organization).
  %is_to_employeeOf(A, Y),
  %in_role(Y, healthCare_accreditation_organization).

is_to_healthCareProvider(A) :-
  is_msg_to_role(A, healthCare_provider).
  %is_to_employeeOf(A, Y),
  %in_role(Y, healthCare_provider).

is_to_secretary(A) :-
  is_msg_to_role(A, government_secretary).

is_to_legalAttorney(A) :-
  is_msg_to_role(A, legal_attorney).

is_to_lawEnforcementOfficer(A) :-
  is_msg_to_role(A, law_enforcement_officer).

is_to_concernedIndividual(A) :-
  is_msg_to_concerned_role(A, individual).

%%%%%%%%%%% ABOUT
is_about_individual(A) :-
  is_msg_about_role(A, individual).

is_about_suspectedCrimePerpetrator(A) :-
  is_msg_about_role(A, suspected_crime_perpetrator).

is_about_adult(A) :-
  is_msg_about_role(A, adult);
  is_msg_about_role(A, emancipated_minor).

is_about_minor(A) :-
  is_msg_about_role(A, unemancipated_minor).

is_about_deceasedIndividual(A) :-
  is_msg_about_role(A, deceased_individual).

%%%%%%%%%% TYPE
is_phi(A) :-
  is_msg_type(A, phi).

%%%%%%%%%% PURPOSE
is_for_eitherPurpose(A):-
  has_msg_purpose(A, healthCare_operations);
  %(has_msg_purpose(A, Y),
  %purpose(Y, healthCare_operations));
  has_msg_purpose(A, payment);
  %(has_msg_purpose(A, Y),
  %purpose(Y, payment));
  has_msg_purpose(A, treatment).
  %(has_msg_purpose(A, Y),
  %purpose(Y, treatment)).
  
is_for_incidentToUse(A) :-
  has_msg_purpose(A, incident_to_use).

is_for_createDeidentifiedInfo(A) :-
  has_msg_purpose(A, create_deidentified_info).

is_for_createProtectedHealthInfo(A) :-
  has_msg_purpose(A, create_protected_health_info).

is_for_receiveProtectedHealthInfo(A) :-
  has_msg_purpose(A, receive_protected_health_info).

is_for_investigation(A) :-
   has_msg_purpose(A, investigate).

is_for_treatment(A) :-
   has_msg_purpose(A, treatment).

is_for_payment(A) :-
   has_msg_purpose(A, payment).

is_for_healthCareOperations(A) :-
   has_msg_purpose(A, healthCare_operations).

is_for_definitionOfHealthCareOperations(A) :-
   has_msg_purpose(A, definition_of_healthCare_operations).

is_for_healthCareFraudAbuseDetection(A) :-
   has_msg_purpose(A, healthCare_fraud_abuse_detection).

is_for_compliance(A) :-
   has_msg_purpose(A, compliance).

is_for_determiningLegalOptions(A) :-
   has_msg_purpose(A, determining_legal_options).

is_for_standardsFailureMisconduct(A, Y) :-
   has_msg_purpose(A, standards_failure_misconduct).

is_for_obtainingAuthorization(A):- 
  has_msg_purpose(A, obtaining_authorization).

%%%%%%%%%%%%% REPLY TO
is_replyTo_request(A) :-
  is_msg_replyto(A, B),
  B \= null,
  (has_msg_purpose(B, requested_by_Individual);
  is_replyTo_request(B)).

%%%%%%%%%%%%% CONSENTED BY
is_consentedby_about(A) :-
  msg_about(A, X),
  is_msg_consentedby(A,X).

%%%%%%%%%%%%% BELIEF
is_belief_from_unlawfulCoveredEntity(A, Y) :-
  msg_from(A, X),
  has_msg_belief(A, Y, unlawful_covered_entity, X).

is_belief_from_employeeVictimOfCriminalAct(A, Y) :-
  msg_from(A, X),
  has_msg_belief(A, Y, employee_victim_of_criminal_act, X).

is_belief_from_minimum(A):- 
  msg_from(A, X),
  has_msg_belief(A, _, minimum_necessary_to_purpose, X).

is_belief_from_about_pertainingToRelationship(A):- 
  msg_from(A, X),
  msg_about(A,Y),
  has_msg_belief(A, Y, minimum_necessary_to_purpose, X).


%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%%%%%%%% in_role heirarchy
in_role(healthCare_provider, covered_entity).
in_role(healthCare_plan, covered_entity).
in_role(healthCare_clearing_house, covered_entity).
in_role(X,Y) :-
  inRole(X,Y).

%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%%transitive closure of basic relations.
%%The terminal relation should be specified outside.

%Transitive closures are going into infinite loops

in_role_closures(X, Y) :-
  in_role(X, Y).

in_role_closures(X, Y) :-
  in_role(X, Z),
  in_role_closures(Z, Y).

%in_role(X, Y) :-
  %in_role(X, Z),
  %in_role(Z, Y).

%in_relation(X, Y) :-
  %in_relation(X, Z),
  %in_relation(Z, Y).


