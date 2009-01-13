:- ['H164.504.pl'].
%%Disclosures to Business Associates

permitted_by_164_502_e(A):-
  excluded_164_502_e_1_ii(A);
  permitted_by_164_502_e_1_i(A).
  %not sure what this means. non-compliance of BA.
  %permitted_164_502_e_1_iii(A).
  %surely cant implement this written notice thing.
  %permitted_164_502_e_2(A).

%See if the message is allowed to be received by any of the covered entities of 
%this business associate or if the covered entity is disclosing protected health.
%to a business associate. An entity is a business associate of some covered entity 
%if that covered entity receives assurance that the BA will appropriately
%safeguard the info and act on behalf of the covered entity. 

permitted_by_164_502_e_1_i(A) :-
  is_phi(A),
  ( (is_from_coveredEntity(A),
     is_to_businessAssociateOf(A),
     is_belief_to_lawfulBusinessAssociate(A, X));
    (is_to_coveredEntity(A),
     is_from_businessAssociateOf(A),
     is_belief_from_lawfulBusinessAssociate(A, X))
  ),
  (is_for_createProtectedHealthInfo(A);
   is_for_receiveProtectedHealthInfo(A)),
  writeln('HIPAA rule 164_502_e_1_i;').

excluded_164_502_e_1_ii(A):-
  excluded_164_502_e_1_ii_a(A);
  excluded_164_502_e_1_ii_b(A);
  excluded_164_502_e_1_ii_c(A).
  
excluded_164_502_e_1_ii_a(A) :-
  is_about_individual(A),
  is_to_healthCareProvider(A),
  is_for_treatment(A),
  is_from_coveredEntity(A),
  writeln('HIPAA rule 164_502_e_1_ii_a;').
  
excluded_164_502_e_1_ii_b(A) :-
  %to plan sponsor
  (is_from_healthInsuranceIssuer(A);
   is_from_groupHealthPlan(A)),
  permitted_by_164_504_f(A),
  writeln('HIPAA rule 164_502_e_1_ii_b;').
% "with respect to a group health plan" could be represented by storing group health plan in type or purpose? 
  
%enrollment information is collected by the government agency.  
%(incomplete) lot of insurance stuff
excluded_164_502_e_1_ii_c(A) :- 
  is_from_governmentAgencyHealthPlan(A),
  writeln('HIPAA rule 164_502_e_1_ii_c;').

forbidden_by_164_502_e(A) :-
  fail.
