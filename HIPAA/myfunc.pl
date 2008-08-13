%:- ['odbc.pl'].


% filter_role_list(Unfiltered, Filtered)
%  
filter_list([], []).
filter_list([H|T], [X|Y]) :-
	atom(H),
	H=X,
	filter_list(T,Y).
filter_list([H|T], [X|Y]) :-
        X='anything',
	filter_list(T, Y).






