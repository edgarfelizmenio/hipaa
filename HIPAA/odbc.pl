:- import odbc_open/3 from odbc_call.
:- odbc_open('MySQL-test', root, www). 

% assert_in_role(MySQL_tuples)
%
%  Pulls inRole rules from SQL Database and adds them  to the Prolog Database
assert_in_role(_) :-
	findall(inRole(Person, Role), odbc_sql([], 'SELECT person, role FROM in_role', [Person, Role]), Results),
	assert_each(Results).

% find_role_leaves(Leaves)
%
%  Retrieves all terminating roles
find_role_leaves(Leaves) :-
	findall(Person, odbc_sql([], 'SELECT DISTINCT person FROM in_role', [Person]), Results),
	filter_leaves(Results, Leaves).

% assert_each(Rule_list)
%   Adds each rule from the Rule_list into Prolog Database
assert_each([]).    
assert_each([H|T]) :-
%	writeln(H),
	assert(H),
	assert_each(T).

% filter_leaves(Role_nodes, Leaves)
%
%   Given a list of role nodes, returns a filtered list of leaves
filter_leaves([], []).
filter_leaves([H|T], [X|Y]) :-
	atom(H),
	is_role_leaf(H),
	H=X,
	filter_leaves(T,Y).
filter_leaves([_|T], L) :-
	filter_leaves(T, L).



