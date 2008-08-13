%:- ['odbc.pl'].


% filter_var_any(Unfiltered, Filtered)
%  filters and replaces _h2345 type vars with anything
%  and then terminates recursion
filter_var_any([], []).
filter_var_any([H|T], [X|Y]) :-
	atom(H),
	H=X,
	filter_var_any(T,Y).
filter_var_any(_, [X|Y]) :-
        X='anything',
	Y = [].


% filter_vars(Unfiltered, Filtered)
%  filters the list, skipping over _h234 type variables
filter_vars([], []).
filter_vars([H|T], [X|Y]) :-
	atom(H),
	H=X,
	filter_vars(T,Y).
filter_vars([_|T], L) :-
	filter_vars(T, L).


% filter_inner_role_nodes(RoleList, LeafRoles)
% 
%   Filters out the inner nodes of the role tree, leaving only leaf roles
%   of the predicate inRole.  Eg. doctor, nurse, surgeon are filtered out,
%   leaving dr_cox, carla, dr_turk 
filter_inner_role_nodes([], []).
filter_inner_role_nodes([H|T], [X|Y]) :-
	atom(H),
        is_role_leaf(H),
	H=X,
	filter_inner_role_nodes(T,Y).
filter_inner_role_nodes([_|T], L) :-
	filter_inner_role_nodes(T, L).


% is_role_leaf(Role)
%   Success if the role given is a leaf node
%   In other words, noone else is inRole of this Role.
is_role_leaf(Role) :- 
	not(inRole(_,Role)). /* Node grounded */




