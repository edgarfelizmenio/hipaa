%% Define the basic data structure of the message.
%% All the rules have 'msg' in them to specify that these rules depend on the msg structure
% a(to, from, about, type, purpose, in Reply to, consented by, belief)
% Belief is also a list with the following list
% b(about, what, believed by)
% One for the person and one for the role.
%consented by is a tuple : (person,consent_type)
 

msg_to(a(X,_,_,_,_,_,_,_), X).

is_msg_to_role(A, Y):-
  msg_to(A, X),
  %in_role(X, Y).
  in_role_closures(X, Y).

msg_to_concerned(a(X,_,X,_,_,_,_,_), X).

is_msg_to_concerned_role(A, Y):-
  msg_to_concerned(A, X),
  %in_role(X, Y).
  in_role_closures(X, Y).

msg_from(a(_,X,_,_,_,_,_,_), X).

is_msg_from_role(A, Y) :-
  msg_from(A, X),
  %in_role(X, Y).
  in_role_closures(X, Y).

msg_from_concerned(a(_,X,X,_,_,_,_,_), X).

is_msg_from_concerned_role(A, Y):-
  msg_from_concerned(A, X),
  %in_role(X, Y).
  in_role_closures(X, Y).

msg_about(a(_,_,X,_,_,_,_,_), X).

is_msg_about_role(A, Y):-
  msg_about(A, X),
  %in_role(X, Y).
  in_role_closures(X, Y).

is_msg_type(a(_,_,_,X,_,_,_,_), Y):-
in_type_closures(X,Y).

has_msg_purpose(a(_,_,_,_,X,_,_,_), X).

is_msg_replyto(a(_,_,_,_,_,X,_,_),X).

is_msg_consented(a(_,_,_,_,_,_,(X,consented),_),X).

is_msg_consent_opp_given(a(_,_,_,_,_,_,(X,opp_given),_),X).


msg_belief(a(_,_,_,_,_,_,_,b(X,Y,Z)), X,Y,Z).

has_msg_belief(A, ABT, WHAT, BY):-
  msg_belief(A, ABT, WHAT, BY).

is_msg_to_within(a(X,Y,_,_,_,_,_,_)):-
  employee_of(X, Z),
  employee_of(Y, Z).

is_msg_about_to_inRelation(a(Y,_,X,_,_,_,_,_)):-
%in relation is not commutative and should be careful which way
%in 164.506 Y has or has had relationship with X
  in_relation(X, Y).


  
