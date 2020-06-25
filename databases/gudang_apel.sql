-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 25 Jun 2020 pada 08.49
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gudang_apel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id` int(11) NOT NULL,
  `fk_pembelian` int(11) NOT NULL,
  `fk_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int(11) NOT NULL,
  `fk_penjualan` int(11) NOT NULL,
  `fk_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `fk_penjualan`, `fk_produk`, `jumlah`) VALUES
(1325, 154, 5, 6),
(1326, 154, 6, 4),
(1327, 154, 7, 15),
(1328, 154, 8, 28),
(1329, 154, 9, 13),
(1330, 154, 10, 5),
(1331, 154, 11, 6),
(1332, 154, 12, 8),
(1333, 154, 13, 25),
(1334, 154, 14, 28),
(1335, 154, 15, 14),
(1336, 154, 16, 8),
(1337, 154, 17, 6),
(1338, 155, 5, 5),
(1339, 155, 6, 4),
(1340, 155, 7, 16),
(1341, 155, 8, 24),
(1342, 155, 9, 11),
(1343, 155, 10, 6),
(1344, 155, 11, 8),
(1345, 155, 12, 5),
(1346, 155, 13, 26),
(1347, 155, 14, 30),
(1348, 155, 15, 24),
(1349, 155, 16, 8),
(1350, 155, 17, 5),
(1351, 156, 5, 3),
(1352, 156, 6, 6),
(1353, 156, 7, 17),
(1354, 156, 8, 25),
(1355, 156, 9, 11),
(1356, 156, 10, 7),
(1357, 156, 11, 8),
(1358, 156, 12, 8),
(1359, 156, 13, 26),
(1360, 156, 14, 28),
(1361, 156, 15, 30),
(1362, 156, 16, 8),
(1363, 156, 17, 8),
(1364, 157, 5, 3),
(1365, 157, 6, 7),
(1366, 157, 7, 17),
(1367, 157, 8, 24),
(1368, 157, 9, 14),
(1369, 157, 10, 6),
(1370, 157, 11, 7),
(1371, 157, 12, 6),
(1372, 157, 13, 24),
(1373, 157, 14, 30),
(1374, 157, 15, 26),
(1375, 157, 16, 9),
(1376, 157, 17, 6),
(1377, 158, 5, 5),
(1378, 158, 6, 6),
(1379, 158, 7, 16),
(1380, 158, 8, 23),
(1381, 158, 9, 13),
(1382, 158, 10, 6),
(1383, 158, 11, 7),
(1384, 158, 12, 9),
(1385, 158, 13, 26),
(1386, 158, 14, 32),
(1387, 158, 15, 17),
(1388, 158, 16, 6),
(1389, 158, 17, 7),
(1390, 159, 5, 6),
(1391, 159, 6, 4),
(1392, 159, 7, 17),
(1393, 159, 8, 27),
(1394, 159, 9, 11),
(1395, 159, 10, 7),
(1396, 159, 11, 8),
(1397, 159, 12, 7),
(1398, 159, 13, 25),
(1399, 159, 14, 31),
(1400, 159, 15, 23),
(1401, 159, 16, 8),
(1402, 159, 17, 6),
(1403, 160, 5, 5),
(1404, 160, 6, 6),
(1405, 160, 7, 15),
(1406, 160, 8, 25),
(1407, 160, 9, 11),
(1408, 160, 10, 7),
(1409, 160, 11, 7),
(1410, 160, 12, 8),
(1411, 160, 13, 26),
(1412, 160, 14, 30),
(1413, 160, 15, 26),
(1414, 160, 16, 7),
(1415, 160, 17, 4),
(1416, 161, 5, 7),
(1417, 161, 6, 5),
(1418, 161, 7, 16),
(1419, 161, 8, 23),
(1420, 161, 9, 10),
(1421, 161, 10, 6),
(1422, 161, 11, 8),
(1423, 161, 12, 6),
(1424, 161, 13, 24),
(1425, 161, 14, 30),
(1426, 161, 15, 27),
(1427, 161, 16, 5),
(1428, 161, 17, 6),
(1429, 162, 5, 5),
(1430, 162, 6, 7),
(1431, 162, 7, 16),
(1432, 162, 8, 25),
(1433, 162, 9, 13),
(1434, 162, 10, 7),
(1435, 162, 11, 6),
(1436, 162, 12, 6),
(1437, 162, 13, 23),
(1438, 162, 14, 30),
(1439, 162, 15, 27),
(1440, 162, 16, 7),
(1441, 162, 17, 4),
(1442, 163, 5, 3),
(1443, 163, 6, 7),
(1444, 163, 7, 14),
(1445, 163, 8, 27),
(1446, 163, 9, 13),
(1447, 163, 10, 7),
(1448, 163, 11, 5),
(1449, 163, 12, 4),
(1450, 163, 13, 21),
(1451, 163, 14, 32),
(1452, 163, 15, 21),
(1453, 163, 16, 8),
(1454, 163, 17, 7),
(1455, 164, 5, 2),
(1456, 164, 6, 5),
(1457, 164, 7, 16),
(1458, 164, 8, 23),
(1459, 164, 9, 12),
(1460, 164, 10, 5),
(1461, 164, 11, 7),
(1462, 164, 12, 7),
(1463, 164, 13, 27),
(1464, 164, 14, 32),
(1465, 164, 15, 24),
(1466, 164, 16, 7),
(1467, 164, 17, 8),
(1468, 165, 5, 2),
(1469, 165, 6, 6),
(1470, 165, 7, 14),
(1471, 165, 8, 25),
(1472, 165, 9, 12),
(1473, 165, 10, 5),
(1474, 165, 11, 6),
(1475, 165, 12, 6),
(1476, 165, 13, 26),
(1477, 165, 14, 30),
(1478, 165, 15, 25),
(1479, 165, 16, 5),
(1480, 165, 17, 5),
(1481, 166, 5, 4),
(1482, 166, 6, 5),
(1483, 166, 7, 15),
(1484, 166, 8, 24),
(1485, 166, 9, 13),
(1486, 166, 10, 5),
(1487, 166, 11, 7),
(1488, 166, 12, 6),
(1489, 166, 13, 21),
(1490, 166, 14, 31),
(1491, 166, 15, 29),
(1492, 166, 16, 7),
(1493, 166, 17, 5),
(1494, 167, 5, 6),
(1495, 167, 6, 7),
(1496, 167, 7, 12),
(1497, 167, 8, 23),
(1498, 167, 9, 12),
(1499, 167, 10, 7),
(1500, 167, 11, 6),
(1501, 167, 12, 7),
(1502, 167, 13, 23),
(1503, 167, 14, 35),
(1504, 167, 15, 32),
(1505, 167, 16, 7),
(1506, 167, 17, 6),
(1507, 168, 5, 10),
(1508, 168, 6, 12),
(1509, 168, 7, 17),
(1510, 168, 8, 29),
(1511, 168, 9, 13),
(1512, 168, 10, 7),
(1513, 168, 11, 8),
(1514, 168, 12, 8),
(1515, 168, 13, 27),
(1516, 168, 14, 37),
(1517, 168, 15, 34),
(1518, 168, 16, 8),
(1519, 168, 17, 8),
(1520, 169, 5, 11),
(1521, 169, 6, 12),
(1522, 169, 7, 19),
(1523, 169, 8, 29),
(1524, 169, 9, 15),
(1525, 169, 10, 8),
(1526, 169, 11, 9),
(1527, 169, 12, 9),
(1528, 169, 13, 25),
(1529, 169, 14, 38),
(1530, 169, 15, 34),
(1531, 169, 16, 8),
(1532, 169, 17, 7),
(1533, 170, 5, 14),
(1534, 170, 6, 10),
(1535, 170, 7, 17),
(1536, 170, 8, 30),
(1537, 170, 9, 14),
(1538, 170, 10, 7),
(1539, 170, 11, 8),
(1540, 170, 12, 8),
(1541, 170, 13, 27),
(1542, 170, 14, 38),
(1543, 170, 15, 38),
(1544, 170, 16, 9),
(1545, 170, 17, 8),
(1546, 171, 5, 5),
(1547, 171, 6, 5),
(1548, 171, 7, 17),
(1549, 171, 8, 30),
(1550, 171, 9, 13),
(1551, 171, 10, 5),
(1552, 171, 11, 8),
(1553, 171, 12, 7),
(1554, 171, 13, 23),
(1555, 171, 14, 30),
(1556, 171, 15, 14),
(1557, 171, 16, 8),
(1558, 171, 17, 7),
(1559, 172, 5, 6),
(1560, 172, 6, 4),
(1561, 172, 7, 14),
(1562, 172, 8, 23),
(1563, 172, 9, 10),
(1564, 172, 10, 7),
(1565, 172, 11, 8),
(1566, 172, 12, 6),
(1567, 172, 13, 23),
(1568, 172, 14, 32),
(1569, 172, 15, 26),
(1570, 172, 16, 8),
(1571, 172, 17, 6),
(1572, 173, 5, 3),
(1573, 173, 6, 7),
(1574, 173, 7, 18),
(1575, 173, 8, 25),
(1576, 173, 9, 12),
(1577, 173, 10, 5),
(1578, 173, 11, 7),
(1579, 173, 12, 7),
(1580, 173, 13, 30),
(1581, 173, 14, 32),
(1582, 173, 15, 30),
(1583, 173, 16, 7),
(1584, 173, 17, 7),
(1585, 174, 5, 4),
(1586, 174, 6, 4),
(1587, 174, 7, 18),
(1588, 174, 8, 24),
(1589, 174, 9, 15),
(1590, 174, 10, 4),
(1591, 174, 11, 7),
(1592, 174, 12, 6),
(1593, 174, 13, 23),
(1594, 174, 14, 30),
(1595, 174, 15, 30),
(1596, 174, 16, 9),
(1597, 174, 17, 5),
(1598, 175, 5, 5),
(1599, 175, 6, 5),
(1600, 175, 7, 16),
(1601, 175, 8, 21),
(1602, 175, 9, 13),
(1603, 175, 10, 4),
(1604, 175, 11, 6),
(1605, 175, 12, 7),
(1606, 175, 13, 26),
(1607, 175, 14, 34),
(1608, 175, 15, 19),
(1609, 175, 16, 6),
(1610, 175, 17, 6),
(1611, 176, 5, 5),
(1612, 176, 6, 5),
(1613, 176, 7, 17),
(1614, 176, 8, 30),
(1615, 176, 9, 13),
(1616, 176, 10, 5),
(1617, 176, 11, 8),
(1618, 176, 12, 7),
(1619, 176, 13, 23),
(1620, 176, 14, 30),
(1621, 176, 15, 14),
(1622, 176, 16, 8),
(1623, 176, 17, 7),
(1624, 177, 5, 6),
(1625, 177, 6, 4),
(1626, 177, 7, 17),
(1627, 177, 8, 25),
(1628, 177, 9, 10),
(1629, 177, 10, 6),
(1630, 177, 11, 7),
(1631, 177, 12, 6),
(1632, 177, 13, 26),
(1633, 177, 14, 32),
(1634, 177, 15, 26),
(1635, 177, 16, 7),
(1636, 177, 17, 5),
(1637, 178, 5, 7),
(1638, 178, 6, 5),
(1639, 178, 7, 15),
(1640, 178, 8, 25),
(1641, 178, 9, 13),
(1642, 178, 10, 5),
(1643, 178, 11, 5),
(1644, 178, 12, 7),
(1645, 178, 13, 21),
(1646, 178, 14, 32),
(1647, 178, 15, 27),
(1648, 178, 16, 5),
(1649, 178, 17, 5),
(1650, 179, 5, 5),
(1651, 179, 6, 6),
(1652, 179, 7, 14),
(1653, 179, 8, 25),
(1654, 179, 9, 12),
(1655, 179, 10, 4),
(1656, 179, 11, 6),
(1657, 179, 12, 6),
(1658, 179, 13, 20),
(1659, 179, 14, 30),
(1660, 179, 15, 27),
(1661, 179, 16, 7),
(1662, 179, 17, 6),
(1663, 180, 5, 4),
(1664, 180, 6, 6),
(1665, 180, 7, 15),
(1666, 180, 8, 28),
(1667, 180, 9, 12),
(1668, 180, 10, 5),
(1669, 180, 11, 5),
(1670, 180, 12, 4),
(1671, 180, 13, 25),
(1672, 180, 14, 35),
(1673, 180, 15, 21),
(1674, 180, 16, 5),
(1675, 180, 17, 7),
(1676, 181, 5, 2),
(1677, 181, 6, 4),
(1678, 181, 7, 17),
(1679, 181, 8, 23),
(1680, 181, 9, 10),
(1681, 181, 10, 6),
(1682, 181, 11, 6),
(1683, 181, 12, 6),
(1684, 181, 13, 26),
(1685, 181, 14, 30),
(1686, 181, 15, 25),
(1687, 181, 16, 7),
(1688, 181, 17, 5),
(1689, 182, 5, 3),
(1690, 182, 6, 5),
(1691, 182, 7, 13),
(1692, 182, 8, 25),
(1693, 182, 9, 11),
(1694, 182, 10, 4),
(1695, 182, 11, 8),
(1696, 182, 12, 6),
(1697, 182, 13, 23),
(1698, 182, 14, 33),
(1699, 182, 15, 27),
(1700, 182, 16, 6),
(1701, 182, 17, 5),
(1702, 183, 5, 2),
(1703, 183, 6, 5),
(1704, 183, 7, 14),
(1705, 183, 8, 23),
(1706, 183, 9, 12),
(1707, 183, 10, 4),
(1708, 183, 11, 7),
(1709, 183, 12, 6),
(1710, 183, 13, 20),
(1711, 183, 14, 30),
(1712, 183, 15, 29),
(1713, 183, 16, 5),
(1714, 183, 17, 7),
(1715, 184, 5, 7),
(1716, 184, 6, 6),
(1717, 184, 7, 13),
(1718, 184, 8, 25),
(1719, 184, 9, 13),
(1720, 184, 10, 6),
(1721, 184, 11, 8),
(1722, 184, 12, 7),
(1723, 184, 13, 25),
(1724, 184, 14, 35),
(1725, 184, 15, 32),
(1726, 184, 16, 7),
(1727, 184, 17, 6),
(1728, 185, 5, 10),
(1729, 185, 6, 12),
(1730, 185, 7, 18),
(1731, 185, 8, 28),
(1732, 185, 9, 13),
(1733, 185, 10, 8),
(1734, 185, 11, 9),
(1735, 185, 12, 8),
(1736, 185, 13, 30),
(1737, 185, 14, 39),
(1738, 185, 15, 36),
(1739, 185, 16, 9),
(1740, 185, 17, 8),
(1741, 186, 5, 12),
(1742, 186, 6, 12),
(1743, 186, 7, 19),
(1744, 186, 8, 29),
(1745, 186, 9, 14),
(1746, 186, 10, 8),
(1747, 186, 11, 8),
(1748, 186, 12, 8),
(1749, 186, 13, 25),
(1750, 186, 14, 38),
(1751, 186, 15, 37),
(1752, 186, 16, 10),
(1753, 186, 17, 8),
(1754, 187, 5, 13),
(1755, 187, 6, 11),
(1756, 187, 7, 17),
(1757, 187, 8, 29),
(1758, 187, 9, 14),
(1759, 187, 10, 7),
(1760, 187, 11, 8),
(1761, 187, 12, 8),
(1762, 187, 13, 27),
(1763, 187, 14, 38),
(1764, 187, 15, 37),
(1765, 187, 16, 9),
(1766, 187, 17, 9),
(1767, 188, 5, 4),
(1768, 188, 6, 6),
(1769, 188, 7, 14),
(1770, 188, 8, 25),
(1771, 188, 9, 13),
(1772, 188, 10, 6),
(1773, 188, 11, 6),
(1774, 188, 12, 5),
(1775, 188, 13, 23),
(1776, 188, 14, 28),
(1777, 188, 15, 16),
(1778, 188, 16, 8),
(1779, 188, 17, 4),
(1780, 189, 5, 7),
(1781, 189, 6, 5),
(1782, 189, 7, 12),
(1783, 189, 8, 23),
(1784, 189, 9, 12),
(1785, 189, 10, 5),
(1786, 189, 11, 6),
(1787, 189, 12, 6),
(1788, 189, 13, 20),
(1789, 189, 14, 32),
(1790, 189, 15, 24),
(1791, 189, 16, 8),
(1792, 189, 17, 5),
(1793, 190, 5, 4),
(1794, 190, 6, 8),
(1795, 190, 7, 18),
(1796, 190, 8, 25),
(1797, 190, 9, 13),
(1798, 190, 10, 6),
(1799, 190, 11, 7),
(1800, 190, 12, 7),
(1801, 190, 13, 30),
(1802, 190, 14, 30),
(1803, 190, 15, 28),
(1804, 190, 16, 7),
(1805, 190, 17, 7),
(1806, 191, 5, 5),
(1807, 191, 6, 5),
(1808, 191, 7, 18),
(1809, 191, 8, 27),
(1810, 191, 9, 11),
(1811, 191, 10, 4),
(1812, 191, 11, 7),
(1813, 191, 12, 8),
(1814, 191, 13, 23),
(1815, 191, 14, 28),
(1816, 191, 15, 30),
(1817, 191, 16, 8),
(1818, 191, 17, 6),
(1819, 192, 5, 5),
(1820, 192, 6, 6),
(1821, 192, 7, 17),
(1822, 192, 8, 24),
(1823, 192, 9, 11),
(1824, 192, 10, 3),
(1825, 192, 11, 8),
(1826, 192, 12, 7),
(1827, 192, 13, 26),
(1828, 192, 14, 32),
(1829, 192, 15, 17),
(1830, 192, 16, 6),
(1831, 192, 17, 6),
(1832, 193, 5, 5),
(1833, 193, 6, 5),
(1834, 193, 7, 17),
(1835, 193, 8, 28),
(1836, 193, 9, 11),
(1837, 193, 10, 5),
(1838, 193, 11, 7),
(1839, 193, 12, 7),
(1840, 193, 13, 21),
(1841, 193, 14, 27),
(1842, 193, 15, 16),
(1843, 193, 16, 7),
(1844, 193, 17, 7),
(1845, 194, 5, 7),
(1846, 194, 6, 4),
(1847, 194, 7, 18),
(1848, 194, 8, 24),
(1849, 194, 9, 12),
(1850, 194, 10, 6),
(1851, 194, 11, 7),
(1852, 194, 12, 8),
(1853, 194, 13, 26),
(1854, 194, 14, 32),
(1855, 194, 15, 28),
(1856, 194, 16, 7),
(1857, 194, 17, 5),
(1858, 195, 5, 7),
(1859, 195, 6, 5),
(1860, 195, 7, 15),
(1861, 195, 8, 23),
(1862, 195, 9, 13),
(1863, 195, 10, 8),
(1864, 195, 11, 6),
(1865, 195, 12, 7),
(1866, 195, 13, 23),
(1867, 195, 14, 31),
(1868, 195, 15, 27),
(1869, 195, 16, 6),
(1870, 195, 17, 7),
(1871, 196, 5, 6),
(1872, 196, 6, 7),
(1873, 196, 7, 14),
(1874, 196, 8, 25),
(1875, 196, 9, 13),
(1876, 196, 10, 4),
(1877, 196, 11, 7),
(1878, 196, 12, 6),
(1879, 196, 13, 18),
(1880, 196, 14, 30),
(1881, 196, 15, 27),
(1882, 196, 16, 5),
(1883, 196, 17, 6),
(1884, 197, 5, 5),
(1885, 197, 6, 8),
(1886, 197, 7, 15),
(1887, 197, 8, 28),
(1888, 197, 9, 14),
(1889, 197, 10, 6),
(1890, 197, 11, 5),
(1891, 197, 12, 5),
(1892, 197, 13, 23),
(1893, 197, 14, 34),
(1894, 197, 15, 24),
(1895, 197, 16, 7),
(1896, 197, 17, 7),
(1897, 198, 5, 4),
(1898, 198, 6, 6),
(1899, 198, 7, 15),
(1900, 198, 8, 25),
(1901, 198, 9, 11),
(1902, 198, 10, 6),
(1903, 198, 11, 7),
(1904, 198, 12, 7),
(1905, 198, 13, 26),
(1906, 198, 14, 30),
(1907, 198, 15, 25),
(1908, 198, 16, 7),
(1909, 198, 17, 7),
(1910, 199, 5, 4),
(1911, 199, 6, 5),
(1912, 199, 7, 13),
(1913, 199, 8, 25),
(1914, 199, 9, 12),
(1915, 199, 10, 7),
(1916, 199, 11, 8),
(1917, 199, 12, 7),
(1918, 199, 13, 25),
(1919, 199, 14, 33),
(1920, 199, 15, 27),
(1921, 199, 16, 6),
(1922, 199, 17, 6),
(1923, 200, 5, 3),
(1924, 200, 6, 5),
(1925, 200, 7, 17),
(1926, 200, 8, 20),
(1927, 200, 9, 12),
(1928, 200, 10, 4),
(1929, 200, 11, 9),
(1930, 200, 12, 7),
(1931, 200, 13, 19),
(1932, 200, 14, 27),
(1933, 200, 15, 29),
(1934, 200, 16, 6),
(1935, 200, 17, 7),
(1936, 201, 5, 7),
(1937, 201, 6, 5),
(1938, 201, 7, 13),
(1939, 201, 8, 25),
(1940, 201, 9, 13),
(1941, 201, 10, 6),
(1942, 201, 11, 7),
(1943, 201, 12, 7),
(1944, 201, 13, 25),
(1945, 201, 14, 35),
(1946, 201, 15, 33),
(1947, 201, 16, 7),
(1948, 201, 17, 8),
(1949, 202, 5, 8),
(1950, 202, 6, 11),
(1951, 202, 7, 17),
(1952, 202, 8, 28),
(1953, 202, 9, 10),
(1954, 202, 10, 7),
(1955, 202, 11, 10),
(1956, 202, 12, 9),
(1957, 202, 13, 28),
(1958, 202, 14, 39),
(1959, 202, 15, 36),
(1960, 202, 16, 10),
(1961, 202, 17, 8),
(1962, 203, 5, 12),
(1963, 203, 6, 12),
(1964, 203, 7, 20),
(1965, 203, 8, 24),
(1966, 203, 9, 11),
(1967, 203, 10, 8),
(1968, 203, 11, 8),
(1969, 203, 12, 8),
(1970, 203, 13, 23),
(1971, 203, 14, 37),
(1972, 203, 15, 35),
(1973, 203, 16, 9),
(1974, 203, 17, 8),
(1975, 204, 5, 13),
(1976, 204, 6, 10),
(1977, 204, 7, 18),
(1978, 204, 8, 23),
(1979, 204, 9, 13),
(1980, 204, 10, 7),
(1981, 204, 11, 8),
(1982, 204, 12, 8),
(1983, 204, 13, 27),
(1984, 204, 14, 38),
(1985, 204, 15, 37),
(1986, 204, 16, 9),
(1987, 204, 17, 9),
(1988, 205, 5, 4),
(1989, 205, 6, 5),
(1990, 205, 7, 15),
(1991, 205, 8, 30),
(1992, 205, 9, 12),
(1993, 205, 10, 6),
(1994, 205, 11, 9),
(1995, 205, 12, 8),
(1996, 205, 13, 24),
(1997, 205, 14, 32),
(1998, 205, 15, 17),
(1999, 205, 16, 9),
(2000, 205, 17, 8),
(2001, 206, 5, 6),
(2002, 206, 6, 4),
(2003, 206, 7, 14),
(2004, 206, 8, 23),
(2005, 206, 9, 10),
(2006, 206, 10, 7),
(2007, 206, 11, 8),
(2008, 206, 12, 6),
(2009, 206, 13, 23),
(2010, 206, 14, 31),
(2011, 206, 15, 27),
(2012, 206, 16, 8),
(2013, 206, 17, 6),
(2014, 207, 5, 4),
(2015, 207, 6, 5),
(2016, 207, 7, 17),
(2017, 207, 8, 25),
(2018, 207, 9, 12),
(2019, 207, 10, 5),
(2020, 207, 11, 7),
(2021, 207, 12, 6),
(2022, 207, 13, 30),
(2023, 207, 14, 32),
(2024, 207, 15, 30),
(2025, 207, 16, 7),
(2026, 207, 17, 7),
(2027, 208, 5, 4),
(2028, 208, 6, 4),
(2029, 208, 7, 18),
(2030, 208, 8, 24),
(2031, 208, 9, 14),
(2032, 208, 10, 4),
(2033, 208, 11, 8),
(2034, 208, 12, 6),
(2035, 208, 13, 22),
(2036, 208, 14, 30),
(2037, 208, 15, 30),
(2038, 208, 16, 10),
(2039, 208, 17, 6),
(2040, 209, 5, 5),
(2041, 209, 6, 3),
(2042, 209, 7, 16),
(2043, 209, 8, 21),
(2044, 209, 9, 13),
(2045, 209, 10, 5),
(2046, 209, 11, 6),
(2047, 209, 12, 7),
(2048, 209, 13, 26),
(2049, 209, 14, 34),
(2050, 209, 15, 17),
(2051, 209, 16, 6),
(2052, 209, 17, 6),
(2053, 210, 5, 5),
(2054, 210, 6, 5),
(2055, 210, 7, 17),
(2056, 210, 8, 26),
(2057, 210, 9, 13),
(2058, 210, 10, 5),
(2059, 210, 11, 8),
(2060, 210, 12, 7),
(2061, 210, 13, 21),
(2062, 210, 14, 30),
(2063, 210, 15, 14),
(2064, 210, 16, 8),
(2065, 210, 17, 6),
(2066, 211, 5, 7),
(2067, 211, 6, 4),
(2068, 211, 7, 17),
(2069, 211, 8, 25),
(2070, 211, 9, 10),
(2071, 211, 10, 6),
(2072, 211, 11, 6),
(2073, 211, 12, 6),
(2074, 211, 13, 26),
(2075, 211, 14, 31),
(2076, 211, 15, 27),
(2077, 211, 16, 7),
(2078, 211, 17, 5),
(2079, 212, 5, 7),
(2080, 212, 6, 5),
(2081, 212, 7, 14),
(2082, 212, 8, 22),
(2083, 212, 9, 13),
(2084, 212, 10, 6),
(2085, 212, 11, 6),
(2086, 212, 12, 7),
(2087, 212, 13, 22),
(2088, 212, 14, 32),
(2089, 212, 15, 27),
(2090, 212, 16, 6),
(2091, 212, 17, 6),
(2092, 213, 5, 4),
(2093, 213, 6, 6),
(2094, 213, 7, 15),
(2095, 213, 8, 28),
(2096, 213, 9, 12),
(2097, 213, 10, 6),
(2098, 213, 11, 7),
(2099, 213, 12, 5),
(2100, 213, 13, 25),
(2101, 213, 14, 35),
(2102, 213, 15, 21),
(2103, 213, 16, 5),
(2104, 213, 17, 8),
(2105, 214, 5, 6),
(2106, 214, 6, 6),
(2107, 214, 7, 15),
(2108, 214, 8, 21),
(2109, 214, 9, 11),
(2110, 214, 10, 6),
(2111, 214, 11, 5),
(2112, 214, 12, 5),
(2113, 214, 13, 29),
(2114, 214, 14, 30),
(2115, 214, 15, 25),
(2116, 214, 16, 6),
(2117, 214, 17, 4),
(2118, 215, 5, 5),
(2119, 215, 6, 5),
(2120, 215, 7, 13),
(2121, 215, 8, 25),
(2122, 215, 9, 11),
(2123, 215, 10, 4),
(2124, 215, 11, 7),
(2125, 215, 12, 6),
(2126, 215, 13, 23),
(2127, 215, 14, 35),
(2128, 215, 15, 26),
(2129, 215, 16, 6),
(2130, 215, 17, 5),
(2131, 216, 5, 4),
(2132, 216, 6, 5),
(2133, 216, 7, 14),
(2134, 216, 8, 23),
(2135, 216, 9, 11),
(2136, 216, 10, 7),
(2137, 216, 11, 7),
(2138, 216, 12, 6),
(2139, 216, 13, 20),
(2140, 216, 14, 28),
(2141, 216, 15, 29),
(2142, 216, 16, 4),
(2143, 216, 17, 6),
(2144, 217, 5, 6),
(2145, 217, 6, 4),
(2146, 217, 7, 13),
(2147, 217, 8, 25),
(2148, 217, 9, 13),
(2149, 217, 10, 5),
(2150, 217, 11, 8),
(2151, 217, 12, 7),
(2152, 217, 13, 25),
(2153, 217, 14, 35),
(2154, 217, 15, 30),
(2155, 217, 16, 7),
(2156, 217, 17, 6),
(2157, 218, 5, 10),
(2158, 218, 6, 11),
(2159, 218, 7, 18),
(2160, 218, 8, 26),
(2161, 218, 9, 13),
(2162, 218, 10, 8),
(2163, 218, 11, 9),
(2164, 218, 12, 7),
(2165, 218, 13, 30),
(2166, 218, 14, 39),
(2167, 218, 15, 36),
(2168, 218, 16, 9),
(2169, 218, 17, 8),
(2170, 219, 5, 12),
(2171, 219, 6, 12),
(2172, 219, 7, 20),
(2173, 219, 8, 29),
(2174, 219, 9, 14),
(2175, 219, 10, 8),
(2176, 219, 11, 10),
(2177, 219, 12, 8),
(2178, 219, 13, 25),
(2179, 219, 14, 35),
(2180, 219, 15, 37),
(2181, 219, 16, 9),
(2182, 219, 17, 8),
(2183, 220, 5, 13),
(2184, 220, 6, 11),
(2185, 220, 7, 17),
(2186, 220, 8, 29),
(2187, 220, 9, 14),
(2188, 220, 10, 7),
(2189, 220, 11, 8),
(2190, 220, 12, 8),
(2191, 220, 13, 27),
(2192, 220, 14, 38),
(2193, 220, 15, 36),
(2194, 220, 16, 8),
(2195, 220, 17, 7),
(2196, 221, 5, 11),
(2197, 221, 6, 15),
(2198, 221, 7, 18),
(2199, 221, 8, 30),
(2200, 221, 9, 13),
(2201, 221, 10, 9),
(2202, 221, 11, 9),
(2203, 221, 12, 9),
(2204, 221, 13, 27),
(2205, 221, 14, 39),
(2206, 221, 15, 39),
(2207, 221, 16, 8),
(2208, 221, 17, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mutasi`
--

CREATE TABLE `mutasi` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `fk_produk` int(11) NOT NULL,
  `jenis` varchar(16) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mutasi`
--

INSERT INTO `mutasi` (`id`, `tanggal`, `fk_produk`, `jenis`, `jumlah`, `stok`) VALUES
(128, '2020-06-23 11:25:07', 5, 'Pembelian', 6, 207),
(129, '2020-06-23 11:25:07', 6, 'Pembelian', 4, 209),
(130, '2020-06-23 11:25:07', 7, 'Pembelian', 15, 164),
(131, '2020-06-23 11:25:07', 8, 'Pembelian', 28, 65),
(132, '2020-06-23 11:25:08', 9, 'Pembelian', 13, 163),
(133, '2020-06-23 11:25:08', 10, 'Pembelian', 5, 143),
(134, '2020-06-23 11:25:08', 11, 'Pembelian', 6, 271),
(135, '2020-06-23 11:25:08', 12, 'Pembelian', 8, 164),
(136, '2020-06-23 11:25:08', 13, 'Pembelian', 25, 86),
(137, '2020-06-23 11:25:08', 14, 'Pembelian', 28, 66),
(138, '2020-06-23 11:25:08', 15, 'Pembelian', 14, 134),
(139, '2020-06-23 11:25:08', 16, 'Pembelian', 8, 136),
(140, '2020-06-23 11:25:08', 17, 'Pembelian', 6, 141),
(141, '2020-06-23 12:27:21', 5, 'Pembelian', 5, 212),
(142, '2020-06-23 12:27:21', 6, 'Pembelian', 4, 213),
(143, '2020-06-23 12:27:21', 7, 'Pembelian', 16, 180),
(144, '2020-06-23 12:27:22', 8, 'Pembelian', 24, 89),
(145, '2020-06-23 12:27:22', 9, 'Pembelian', 11, 174),
(146, '2020-06-23 12:27:22', 10, 'Pembelian', 6, 149),
(147, '2020-06-23 12:27:22', 11, 'Pembelian', 8, 279),
(148, '2020-06-23 12:27:22', 12, 'Pembelian', 5, 169),
(149, '2020-06-23 12:27:22', 13, 'Pembelian', 26, 112),
(150, '2020-06-23 12:27:22', 14, 'Pembelian', 30, 96),
(151, '2020-06-23 12:27:22', 15, 'Pembelian', 24, 158),
(152, '2020-06-23 12:27:22', 16, 'Pembelian', 8, 144),
(153, '2020-06-23 12:27:22', 17, 'Pembelian', 5, 146);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasar`
--

CREATE TABLE `pasar` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `alamat` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasar`
--

INSERT INTO `pasar` (`id`, `nama`, `alamat`) VALUES
(1, 'Cibitung', 'Jakarta'),
(3, 'Badung', 'Bali'),
(4, 'Kramajati', 'Jakarta'),
(5, 'Gamping', 'Sleman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `fk_karyawan` int(11) NOT NULL,
  `petani` varchar(32) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `fk_karyawan` int(11) NOT NULL,
  `fk_pasar` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `tanggal`, `fk_karyawan`, `fk_pasar`, `status`) VALUES
(154, '2015-01-06 00:00:00', 1, 3, 1),
(155, '2015-01-14 00:00:00', 1, 3, 1),
(156, '2015-01-21 00:00:00', 1, 3, 1),
(157, '2015-01-28 00:00:00', 1, 3, 1),
(158, '2015-02-07 00:00:00', 1, 3, 1),
(159, '2015-02-11 00:00:00', 1, 3, 1),
(160, '2015-02-19 00:00:00', 1, 3, 1),
(161, '2015-02-25 00:00:00', 1, 3, 1),
(162, '2015-03-02 00:00:00', 1, 3, 1),
(163, '2015-03-08 00:00:00', 1, 3, 1),
(164, '2015-03-15 00:00:00', 1, 3, 1),
(165, '2015-03-24 00:00:00', 1, 3, 1),
(166, '2015-03-30 00:00:00', 1, 3, 1),
(167, '2015-04-06 00:00:00', 1, 3, 1),
(168, '2015-04-14 00:00:00', 1, 3, 1),
(169, '2015-04-19 00:00:00', 1, 3, 1),
(170, '2015-04-27 00:00:00', 1, 3, 1),
(171, '2015-01-06 00:00:00', 1, 1, 1),
(172, '2015-01-14 00:00:00', 1, 1, 1),
(173, '2015-01-21 00:00:00', 1, 1, 1),
(174, '2015-01-28 00:00:00', 1, 1, 1),
(175, '2015-02-07 00:00:00', 1, 1, 1),
(176, '2015-02-11 00:00:00', 1, 1, 1),
(177, '2015-02-19 00:00:00', 1, 1, 1),
(178, '2015-02-25 00:00:00', 1, 1, 1),
(179, '2015-03-02 00:00:00', 1, 1, 1),
(180, '2015-03-08 00:00:00', 1, 1, 1),
(181, '2015-03-15 00:00:00', 1, 1, 1),
(182, '2015-03-24 00:00:00', 1, 1, 1),
(183, '2015-03-30 00:00:00', 1, 1, 1),
(184, '2015-04-06 00:00:00', 1, 1, 1),
(185, '2015-04-14 00:00:00', 1, 1, 1),
(186, '2015-04-19 00:00:00', 1, 1, 1),
(187, '2015-04-27 00:00:00', 1, 1, 1),
(188, '2015-01-06 00:00:00', 1, 5, 1),
(189, '2015-01-14 00:00:00', 1, 5, 1),
(190, '2015-01-21 00:00:00', 1, 5, 1),
(191, '2015-01-28 00:00:00', 1, 5, 1),
(192, '2015-02-07 00:00:00', 1, 5, 1),
(193, '2015-02-11 00:00:00', 1, 5, 1),
(194, '2015-02-19 00:00:00', 1, 5, 1),
(195, '2015-02-25 00:00:00', 1, 5, 1),
(196, '2015-03-02 00:00:00', 1, 5, 1),
(197, '2015-03-08 00:00:00', 1, 5, 1),
(198, '2015-03-15 00:00:00', 1, 5, 1),
(199, '2015-03-24 00:00:00', 1, 5, 1),
(200, '2015-03-30 00:00:00', 1, 5, 1),
(201, '2015-04-06 00:00:00', 1, 5, 1),
(202, '2015-04-14 00:00:00', 1, 5, 1),
(203, '2015-04-19 00:00:00', 1, 5, 1),
(204, '2015-04-27 00:00:00', 1, 5, 1),
(205, '2015-01-06 00:00:00', 1, 4, 1),
(206, '2015-01-14 00:00:00', 1, 4, 1),
(207, '2015-01-21 00:00:00', 1, 4, 1),
(208, '2015-01-28 00:00:00', 1, 4, 1),
(209, '2015-02-07 00:00:00', 1, 4, 1),
(210, '2015-02-11 00:00:00', 1, 4, 1),
(211, '2015-02-19 00:00:00', 1, 4, 1),
(212, '2015-02-25 00:00:00', 1, 4, 1),
(213, '2015-03-02 00:00:00', 1, 4, 1),
(214, '2015-03-08 00:00:00', 1, 4, 1),
(215, '2015-03-15 00:00:00', 1, 4, 1),
(216, '2015-03-24 00:00:00', 1, 4, 1),
(217, '2015-03-30 00:00:00', 1, 4, 1),
(218, '2015-04-06 00:00:00', 1, 4, 1),
(219, '2015-04-14 00:00:00', 1, 4, 1),
(220, '2015-04-19 00:00:00', 1, 4, 1),
(221, '2015-04-27 00:00:00', 1, 4, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `jenis` varchar(32) NOT NULL,
  `ukuran` varchar(32) NOT NULL,
  `stok` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `jenis`, `ukuran`, `stok`) VALUES
(5, 'Merah', '3-4', 212),
(6, 'Merah', '5-6', 213),
(7, 'Merah', '7-8', 180),
(8, 'Merah', '9-10', 89),
(9, 'Merah', '11-15', 174),
(10, 'Merah', '16-20', 149),
(11, 'Manalagi', 'Bom', 279),
(12, 'Manalagi', 'Super', 169),
(13, 'Manalagi', 'ASuper', 112),
(14, 'Manalagi', 'AA', 96),
(15, 'Manalagi', 'AB', 158),
(16, 'Manalagi', 'C', 144),
(17, 'Manalagi', 'D', 146);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `level` int(11) NOT NULL,
  `gambar` varchar(128) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `level`, `gambar`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '27746547d32ec47bdef8e2b9617dc144.jpg'),
(2, 'Lely', 'lelyfz99', '9e5363f585df7738207440b79eddd0c7', 1, '471979ec320948763eaaad44e00826f8.jpg'),
(4, 'Ibrah', 'Ibrahimm', '4d1bbebe981ce135637386610d51fc2f', 2, 'default.png'),
(6, 'sugeng', 'sugeng11', '67e708c70405557a8ac9822a8efafc33', 2, 'default.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `_config`
--

CREATE TABLE `_config` (
  `_key` varchar(16) NOT NULL,
  `_value` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `_config`
--

INSERT INTO `_config` (`_key`, `_value`) VALUES
('alfa', '0.4'),
('beta1', '0.774715710184695'),
('beta2', '0.520990065207925');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pembelian` (`fk_pembelian`),
  ADD KEY `fk_produk` (`fk_produk`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_penjualan` (`fk_penjualan`),
  ADD KEY `fk_produk` (`fk_produk`);

--
-- Indexes for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produk` (`fk_produk`);

--
-- Indexes for table `pasar`
--
ALTER TABLE `pasar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_karwayan` (`fk_karyawan`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pasar` (`fk_pasar`),
  ADD KEY `fk_karyawan` (`fk_karyawan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `_config`
--
ALTER TABLE `_config`
  ADD PRIMARY KEY (`_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2209;
--
-- AUTO_INCREMENT for table `mutasi`
--
ALTER TABLE `mutasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;
--
-- AUTO_INCREMENT for table `pasar`
--
ALTER TABLE `pasar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian_ibfk_1` FOREIGN KEY (`fk_pembelian`) REFERENCES `pembelian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pembelian_ibfk_2` FOREIGN KEY (`fk_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`fk_penjualan`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`fk_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mutasi`
--
ALTER TABLE `mutasi`
  ADD CONSTRAINT `mutasi_ibfk_1` FOREIGN KEY (`fk_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`fk_karyawan`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`fk_pasar`) REFERENCES `pasar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`fk_karyawan`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;