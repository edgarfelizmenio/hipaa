:- ['./HITECH/H1305.pl'].

%%% HITECH
%%%%%%%%%%%%%%%%%%%%%%%% 
%%Roles
%------
%healthCare_plan
%healthCare_clearing_house
%healthCare_provider
%health_oversight_agency
%public_health_authority
%healthCare_accreditation_organization
%coveredEntity
%secretary
%legal_attorney
%law_enforcement_officer
%suspected_crime_perpetrator
%individual - means patient at that hospital
%adult
%emancipated_minor
%unemancipated_minor
%deceased_individual
%healthcare_provider
%health_plan
%health_insurance_issuer
%group_health_plan
%government_agency_health_plan

%% msg types
%-----------
%phi

%%Purpose
%--------
%healthCare_operations
%payment
%treatment
%incident_to_use
%create_deidentified_info
%create_protected_health_info
%receive_deidentified_info
%requested_by_Individual
%investigate
%definition_healthCare_operations
%healthCare_fraud_abuse_detection
%compliance
%determining_legal_options
%standards_failure_misconduct

%% Basic relations
%-----------------
% in_role(X, Y) says if X is in role Y. Here mention if covered entity.
% employee_of(X, Y) says if X is employee of Y
% in_relation(X, Y) says if X is related to Y (its not commutative) X gives rights to Y
% minimum(X, Y) says if for type of message X and purpose Y its minimum information
% business_associate(X, Y) says if X is a business associate of Y.
% personal_representative(X, Y) says if Y is a personal representative of X, includes executor, administrator by law.
% parent(X, Y), guardian(X, Y), loco_parentis(X, Y) says if y is parent of X

%% There is just this one Covered Entity!

%%permitted_by_HIPAA(A):-



permitted_by_self(A) :- 
  msg_from(A, X),
  msg_about(A, Y),
  X = Y.


