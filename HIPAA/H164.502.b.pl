
%%Standard: Minimum neccessary.
%Must be minimum information or law does not apply
permitted_by_164_502_b(A) :-
  permitted_by_164_502_b_1(A);
  excluded_164_502_b_2(A).
  
permitted_by_164_502_b_1(A) :-
  is_from_coveredEntity(A),
  is_to_coveredEntity(A),
  is_belief_from_minimum(A),
  writeln('HIPAA rule 164_502_b_1;').
  
%Minimum necessary does not apply in these cases.
excluded_164_502_b_2(A) :-
  excluded_164_502_b_2_i(A);
  excluded_164_502_b_2_ii(A);
  excluded_164_502_b_2_iii(A);
  excluded_164_502_b_2_iv(A);
  excluded_164_502_b_2_v(A);
  excluded_164_502_b_2_vi(A).  
  
excluded_164_502_b_2_i(A) :-
  is_for_treatment(A),
  is_to_healthCareProvider(A),
  writeln('HIPAA rule 164_502_b_2_i;').
  
excluded_164_502_b_2_ii(A) :-
  (permitted_by_164_502_a_1_i(A);
  required_by_164_502_a_2_i(A)),
  writeln('HIPAA rule 164_502_b_2_ii;').
  
excluded_164_502_b_2_iii(A) :-
  is_for_obtainingAuthorization(A),
  writeln('HIPAA rule 164_502_b_2_iii;').
  
excluded_164_502_b_2_iv(A) :-
  is_to_secretary(A),
  permitted_by_160_C(A),
  writeln('HIPAA rule 164_502_b_2_iv;').
   
excluded_164_502_b_2_v(A) :-   
  required_by_164_512_a(A),
  writeln('HIPAA rule 164_502_b_2_v;').
   
%Need to add all required types. Found only this.
excluded_164_502_b_2_vi(A) :-
  required_by_164_502_a_2(A),
  writeln('HIPAA rule 164_502_b_2_vi;').

