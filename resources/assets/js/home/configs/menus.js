export default [
	{
		label: 'Inicial',
		uri: {
			name: 'home'
		}
	},
	{
		label: 'Notícias',
		dropdown: true,
		subMenus: [
			{	
				label: 'Ultímas noticias',
				uri: {
					name: 'bills'
				}
			}
		]
	},
	{
		label: 'Configurações',
		icon: 'tal',
		uri: "/configs"
	}
]